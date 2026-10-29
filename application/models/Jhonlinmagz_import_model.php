<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jhonlinmagz_import_model extends CI_Model
{
    private $sourceName = 'jhonlinmagz.com';
    private $apiUrl = 'https://www.jhonlinmagz.com/wp-json/wp/v2/posts';
    private $imageDirectory = './assets/file/backend/upload/berita/image';
    private $thumbnailDirectory = './assets/file/backend/upload/berita/thumbnail';

    public function import_recent($categoryId, $language)
    {
        if (!$this->local_category_exists($categoryId) || !$this->local_language_exists($language)) {
            return array('ok' => FALSE, 'error' => 'Pilih kategori dan bahasa lokal yang valid.');
        }

        if (!$this->db->table_exists('tr_post_external_sources')) {
            return array('ok' => FALSE, 'error' => 'Struktur impor belum tersedia. Jalankan migrasi SQL terbaru pada database ini.');
        }

        if (!function_exists('curl_init')) {
            return array('ok' => FALSE, 'error' => 'Ekstensi cURL PHP belum aktif.');
        }

        $fields = rawurlencode('id,date,link,title,content,author,featured_media,_links,_embedded');
        $apiResponse = $this->get_remote_body($this->apiUrl . '?status=publish&per_page=10&_embed=1&_fields=' . $fields, 2000000);
        if (empty($apiResponse['ok'])) {
            return array('ok' => FALSE, 'error' => $apiResponse['error']);
        }

        $posts = json_decode($apiResponse['body'], TRUE);
        if (!is_array($posts) || json_last_error() !== JSON_ERROR_NONE) {
            return array('ok' => FALSE, 'error' => 'Respons REST API Jhonlin Magazine tidak valid.');
        }

        $summary = array('ok' => TRUE, 'imported' => 0, 'duplicates' => 0, 'failed' => 0, 'errors' => array());
        foreach ($posts as $post) {
            if (!is_array($post) || empty($post['id'])) {
                $this->record_import_error($summary, 'Ada item berita dengan data sumber yang tidak lengkap.');
                continue;
            }

            $sourceId = (string) (int) $post['id'];
            if ($this->source_already_imported($sourceId)) {
                $summary['duplicates']++;
                continue;
            }

            try {
                $prepared = $this->prepare_post($post);
                if (empty($prepared['ok'])) {
                    $this->record_import_error($summary, $prepared['error']);
                    continue;
                }

                $featuredImageUrl = isset($post['_embedded']['wp:featuredmedia'][0]['source_url'])
                    ? trim((string) $post['_embedded']['wp:featuredmedia'][0]['source_url'])
                    : '';
                $prepared['content'] = $this->localize_inline_images($prepared['content'], (int) $post['id'], $featuredImageUrl);
                $filename = $this->download_featured_image($post);
                $this->save_imported_post($post, $prepared, $categoryId, $language, $filename);
                $summary['imported']++;
            } catch (Throwable $error) {
                log_message('error', 'Jhonlin Magazine import failed for source post ' . $sourceId . ': ' . $error->getMessage());
                $this->record_import_error($summary, 'Berita sumber #' . $sourceId . ' gagal disimpan.');
            }
        }

        return $summary;
    }

    private function local_category_exists($categoryId)
    {
        return $this->db->where('nu_id', (int) $categoryId)
            ->where('vc_post_category', 'media')
            ->count_all_results('mst_category') > 0;
    }

    private function local_language_exists($language)
    {
        if ($language === '' || strlen($language) > 20) {
            return FALSE;
        }

        return $this->db->where('vc_code', $language)->count_all_results('conf_language') > 0;
    }

    private function source_already_imported($sourceId)
    {
        return $this->db->where('vc_source', $this->sourceName)
            ->where('vc_source_id', $sourceId)
            ->count_all_results('tr_post_external_sources') > 0;
    }

    private function get_remote_body($url, $maxBytes)
    {
        $parts = parse_url($url);
        if (!is_array($parts)
            || !isset($parts['scheme'], $parts['host'])
            || strtolower($parts['scheme']) !== 'https'
            || !in_array(strtolower($parts['host']), array('www.jhonlinmagz.com', 'jhonlinmagz.com'), TRUE)) {
            return array('ok' => FALSE, 'error' => 'Alamat sumber berita tidak diizinkan.');
        }

        $body = '';
        $curl = curl_init($url);
        $curlOptions = array(
            CURLOPT_RETURNTRANSFER => FALSE,
            CURLOPT_FOLLOWLOCATION => FALSE,
            CURLOPT_CONNECTTIMEOUT => 8,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_SSL_VERIFYPEER => TRUE,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_USERAGENT => 'PTJARCOM-News-Importer/1.0',
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS,
            CURLOPT_WRITEFUNCTION => function ($handle, $chunk) use (&$body, $maxBytes) {
                if (strlen($body) + strlen($chunk) > $maxBytes) {
                    return 0;
                }
                $body .= $chunk;
                return strlen($chunk);
            },
        );
        $caBundle = $this->ca_bundle_path();
        if ($caBundle !== NULL) {
            $curlOptions[CURLOPT_CAINFO] = $caBundle;
        }
        curl_setopt_array($curl, $curlOptions);

        $success = curl_exec($curl);
        $status = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $curlError = curl_error($curl);
        curl_close($curl);

        if ($success === FALSE) {
            if (strlen($body) >= $maxBytes) {
                return array('ok' => FALSE, 'error' => 'Respons sumber melebihi batas ukuran yang diizinkan.');
            }
            log_message('error', 'Jhonlin Magazine request failed: ' . $curlError);
            return array('ok' => FALSE, 'error' => 'Tidak dapat menghubungi Jhonlin Magazine.');
        }
        if ($status !== 200) {
            return array('ok' => FALSE, 'error' => 'Jhonlin Magazine mengembalikan HTTP ' . $status . '.');
        }

        return array('ok' => TRUE, 'body' => $body);
    }

    private function ca_bundle_path()
    {
        $candidates = array(
            getenv('PTJARCOM_CURL_CA_BUNDLE'),
            getenv('CURL_CA_BUNDLE'),
            getenv('SSL_CERT_FILE'),
            ini_get('curl.cainfo'),
            ini_get('openssl.cafile'),
        );

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $loadedIni = php_ini_loaded_file();
            if (is_string($loadedIni) && $loadedIni !== '') {
                $candidates[] = dirname($loadedIni) . DIRECTORY_SEPARATOR . 'extras' . DIRECTORY_SEPARATOR . 'ssl' . DIRECTORY_SEPARATOR . 'cacert.pem';
            }
        }

        foreach ($candidates as $candidate) {
            if (is_string($candidate) && $candidate !== '' && is_file($candidate) && is_readable($candidate)) {
                return $candidate;
            }
        }

        return NULL;
    }

    private function prepare_post($post)
    {
        $title = isset($post['title']['rendered']) ? html_entity_decode(strip_tags($post['title']['rendered']), ENT_QUOTES | ENT_HTML5, 'UTF-8') : '';
        $content = isset($post['content']['rendered']) ? trim((string) $post['content']['rendered']) : '';
        $sourceUrl = isset($post['link']) ? trim((string) $post['link']) : '';
        $date = isset($post['date']) ? strtotime($post['date']) : FALSE;

        if ($title === '' || $content === '' || $date === FALSE || !$this->is_allowed_source_url($sourceUrl)) {
            return array('ok' => FALSE, 'error' => 'Berita sumber #' . (int) $post['id'] . ' memiliki judul, isi, tanggal, atau tautan yang tidak valid.');
        }

        $content = $this->security->xss_clean($content);
        if (!is_string($content) || trim($content) === '') {
            return array('ok' => FALSE, 'error' => 'Isi berita sumber #' . (int) $post['id'] . ' tidak lolos pemeriksaan keamanan.');
        }

        $author = 'Jhonlin Magazine';
        if (isset($post['_embedded']['author'][0]['name'])) {
            $author = trim(strip_tags(html_entity_decode($post['_embedded']['author'][0]['name'], ENT_QUOTES | ENT_HTML5, 'UTF-8')));
        }
        $author = $this->security->xss_clean($author);
        if ($author === '') {
            $author = 'Jhonlin Magazine';
        }

        $sourceLink = htmlspecialchars($sourceUrl, ENT_QUOTES, 'UTF-8');
        $content .= '<hr><p><strong>Sumber:</strong> <a href="' . $sourceLink . '" target="_blank" rel="noopener noreferrer">Jhonlin Magazine</a></p>';

        return array(
            'ok' => TRUE,
            'title' => trim($title),
            'content' => $content,
            'author' => $author,
            'source_url' => $sourceUrl,
            'published_at' => date('Y-m-d H:i:s', $date),
            'tags' => $this->extract_tags($post),
        );
    }

    private function is_allowed_source_url($url)
    {
        $parts = parse_url($url);
        return is_array($parts)
            && isset($parts['scheme'], $parts['host'])
            && strtolower($parts['scheme']) === 'https'
            && in_array(strtolower($parts['host']), array('www.jhonlinmagz.com', 'jhonlinmagz.com'), TRUE)
            && empty($parts['user'])
            && empty($parts['pass'])
            && (!isset($parts['port']) || (int) $parts['port'] === 443);
    }

    private function extract_tags($post)
    {
        $tags = array();
        if (empty($post['_embedded']['wp:term']) || !is_array($post['_embedded']['wp:term'])) {
            return $tags;
        }

        foreach ($post['_embedded']['wp:term'] as $terms) {
            if (!is_array($terms)) {
                continue;
            }
            foreach ($terms as $term) {
                if (!is_array($term) || !isset($term['taxonomy'], $term['name']) || $term['taxonomy'] !== 'post_tag') {
                    continue;
                }
                $name = trim(strip_tags(html_entity_decode($term['name'], ENT_QUOTES | ENT_HTML5, 'UTF-8')));
                $name = $this->security->xss_clean($name);
                if ($name !== '' && strlen($name) <= 100) {
                    $tags[$name] = $name;
                }
            }
        }

        return array_slice(array_values($tags), 0, 10);
    }

    private function download_featured_image($post)
    {
        if (empty($post['featured_media']) || empty($post['_embedded']['wp:featuredmedia'][0]['source_url'])) {
            return NULL;
        }

        $imageUrl = trim((string) $post['_embedded']['wp:featuredmedia'][0]['source_url']);
        if (!$this->is_allowed_source_url($imageUrl)) {
            return NULL;
        }

        $filename = 'jhonlinmagz_' . (int) $post['id'] . '_' . (int) $post['featured_media'];
        $filename = $this->download_image_file($imageUrl, $filename, 'featured image for post ' . (int) $post['id']);
        if ($filename === NULL) {
            return NULL;
        }

        $path = rtrim($this->imageDirectory, '/\\') . DIRECTORY_SEPARATOR . $filename;
        $this->create_local_thumbnail($path, $filename);
        return $filename;
    }

    private function localize_inline_images($content, $sourcePostId, $featuredImageUrl = '')
    {
        $seenImageNames = array();
        $featuredImageName = $this->source_image_name_key($featuredImageUrl);
        if ($featuredImageName !== '') {
            $seenImageNames[$featuredImageName] = TRUE;
        }

        $localized = preg_replace_callback('/<img\b[^>]*>/i', function ($matches) use ($sourcePostId, &$seenImageNames) {
            $tag = $matches[0];
            if (!preg_match('/\bsrc\s*=\s*("([^"]*)"|\'([^\']*)\')/i', $tag, $srcMatch)) {
                return $tag;
            }

            $sourceUrl = isset($srcMatch[2]) && $srcMatch[2] !== '' ? $srcMatch[2] : (isset($srcMatch[3]) ? $srcMatch[3] : '');
            $sourceUrl = html_entity_decode($sourceUrl, ENT_QUOTES | ENT_HTML5, 'UTF-8');
            if (!$this->is_allowed_source_url($sourceUrl)) {
                return $tag;
            }

            $imageName = $this->source_image_name_key($sourceUrl);
            if ($imageName !== '' && isset($seenImageNames[$imageName])) {
                return '';
            }
            if ($imageName !== '') {
                $seenImageNames[$imageName] = TRUE;
            }

            $filename = 'jhonlinmagz_inline_' . (int) $sourcePostId . '_' . substr(hash('sha256', $sourceUrl), 0, 16);
            $filename = $this->download_image_file($sourceUrl, $filename, 'inline image for post ' . (int) $sourcePostId);
            if ($filename === NULL) {
                return $tag;
            }

            $webpPath = rtrim($this->imageDirectory, '/\\') . DIRECTORY_SEPARATOR . $filename . '.webp';
            $localFilename = is_file($webpPath) ? $filename . '.webp' : $filename;
            $localUrl = '/assets/file/backend/upload/berita/image/' . rawurlencode($localFilename);
            $tag = preg_replace_callback('/\bsrc\s*=\s*("([^"]*)"|\'([^\']*)\')/i', function () use ($localUrl) {
                return 'src="' . htmlspecialchars($localUrl, ENT_QUOTES, 'UTF-8') . '"';
            }, $tag, 1);
            $tag = preg_replace('/\s+srcset\s*=\s*("[^"]*"|\'[^\']*\')/i', '', $tag);
            return $tag;
        }, $content);

        if (!is_string($localized)) {
            return $content;
        }

        return preg_replace('/<(p|figure)\b[^>]*>\s*<\/\1>/i', '', $localized);
    }

    private function source_image_name_key($url)
    {
        $path = parse_url((string) $url, PHP_URL_PATH);
        if (!is_string($path) || $path === '') {
            return '';
        }

        $filename = rawurldecode(basename($path));
        $filename = preg_replace('/-\d+x\d+(?=\.[^.]+$)/i', '', $filename);
        return strtolower($filename);
    }

    private function download_image_file($imageUrl, $filenamePrefix, $description)
    {
        $response = $this->get_remote_body($imageUrl, 8000000);
        if (empty($response['ok'])) {
            log_message('error', 'Could not download Jhonlin Magazine ' . $description . ': ' . $response['error']);
            return NULL;
        }

        $imageInfo = @getimagesizefromstring($response['body']);
        if (!is_array($imageInfo)
            || empty($imageInfo['mime'])
            || empty($imageInfo[0])
            || empty($imageInfo[1])
            || $imageInfo[0] > 10000
            || $imageInfo[1] > 10000
            || $imageInfo[0] * $imageInfo[1] > 40000000) {
            return NULL;
        }

        $extensions = array('image/jpeg' => 'jpg', 'image/png' => 'png');
        if (!isset($extensions[$imageInfo['mime']])) {
            return NULL;
        }

        $filename = $filenamePrefix . '.' . $extensions[$imageInfo['mime']];
        if (!is_dir($this->imageDirectory) && !@mkdir($this->imageDirectory, 0755, TRUE) && !is_dir($this->imageDirectory)) {
            return NULL;
        }
        $path = rtrim($this->imageDirectory, '/\\') . DIRECTORY_SEPARATOR . $filename;
        if (!is_file($path)) {
            $temporaryPath = tempnam($this->imageDirectory, '.jhonlinmagz-');
            if ($temporaryPath === FALSE) {
                return NULL;
            }
            $written = file_put_contents($temporaryPath, $response['body'], LOCK_EX);
            if ($written !== strlen($response['body']) || !@rename($temporaryPath, $path)) {
                @unlink($temporaryPath);
                return NULL;
            }
            create_webp_sidecar($path);
        }

        return $filename;
    }

    private function create_local_thumbnail($sourcePath, $filename)
    {
        if (!is_dir($this->thumbnailDirectory)
            && !@mkdir($this->thumbnailDirectory, 0755, TRUE)
            && !is_dir($this->thumbnailDirectory)) {
            return;
        }

        $config = array(
            'image_library' => 'gd2',
            'source_image' => $sourcePath,
            'new_image' => rtrim($this->thumbnailDirectory, '/\\') . DIRECTORY_SEPARATOR . $filename,
            'create_thumb' => FALSE,
            'maintain_ratio' => TRUE,
            'width' => 800,
            'height' => 600,
        );
        $this->load->library('image_lib');
        $this->image_lib->initialize($config);
        if ($this->image_lib->resize()) {
            create_webp_sidecar($config['new_image']);
        }
        $this->image_lib->clear();
    }

    private function save_imported_post($sourcePost, $prepared, $categoryId, $language, $filename)
    {
        $now = date('Y-m-d H:i:s');
        $ci = get_instance();
        if (!isset($ci->uuid)) {
            $this->load->library('uuid');
            $ci = get_instance();
        }

        $postData = array(
            'uuid' => $ci->uuid->v4(),
            'vc_category_id' => (int) $categoryId,
            'vc_status' => 0,
            'vc_type' => 'berita',
            'nu_headline' => 0,
            'vc_title' => $prepared['title'],
            'vc_content' => $prepared['content'],
            'vc_slug' => slugify($prepared['title']) . '-jm-' . (int) $sourcePost['id'],
            'vc_author_name' => $prepared['author'],
            'dt_published' => $prepared['published_at'],
            'dt_updated' => $now,
            'dt_created' => $now,
            'vc_lang' => $language,
        );

        $this->db->trans_begin();
        try {
            $this->db->insert('tr_posts', $postData);
            $localPostId = (int) $this->db->insert_id();
            if ($localPostId <= 0) {
                throw new RuntimeException('Local post insert did not return an ID.');
            }

            if ($filename !== NULL) {
                $this->db->insert('tr_post_images', array(
                    'vc_image' => $filename,
                    'int_thumbnail' => 1,
                    'nu_post_id' => $localPostId,
                    'dt_created' => $now,
                    'dt_updated' => $now,
                ));
            }

            foreach ($prepared['tags'] as $tagName) {
                $this->attach_tag($localPostId, $tagName, $now);
            }

            $this->db->insert('tr_post_external_sources', array(
                'vc_source' => $this->sourceName,
                'vc_source_id' => (string) (int) $sourcePost['id'],
                'nu_post_id' => $localPostId,
                'vc_source_url' => $prepared['source_url'],
                'dt_created' => $now,
            ));

            if ($this->db->trans_status() === FALSE) {
                throw new RuntimeException('A database write failed while saving the imported post.');
            }
            $this->db->trans_commit();
        } catch (Throwable $error) {
            $this->db->trans_rollback();
            throw $error;
        }
    }

    private function attach_tag($postId, $tagName, $now)
    {
        $existingTag = $this->db->get_where('tr_tags', array('vc_name' => $tagName))->row_array();
        if (empty($existingTag)) {
            $this->db->insert('tr_tags', array(
                'vc_name' => $tagName,
                'vc_slug' => slugify($tagName),
                'nu_count' => 1,
                'dt_updated' => $now,
                'dt_created' => $now,
            ));
            $tagId = (int) $this->db->insert_id();
        } else {
            $tagId = (int) $existingTag['nu_id'];
            $this->db->where('nu_id', $tagId)->update('tr_tags', array(
                'nu_count' => (int) $existingTag['nu_count'] + 1,
                'dt_updated' => $now,
            ));
        }

        if ($tagId > 0) {
            $this->db->insert('tr_post_tag', array('vc_post_id' => $postId, 'vc_tag_id' => $tagId));
        }
    }

    private function record_import_error(&$summary, $message)
    {
        $summary['failed']++;
        $summary['errors'][] = $message;
    }
}
