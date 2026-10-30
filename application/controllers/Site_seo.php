<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Site_seo extends CI_Controller
{
    public function robots()
    {
        $body = "User-agent: *\n"
            . "Allow: /\n"
            . "Disallow: /sitemanager\n"
            . "Disallow: /Search\n"
            . "Sitemap: " . frontend_seo_canonical_base() . "sitemap.xml\n";

        $this->output
            ->set_content_type('text/plain', 'utf-8')
            ->set_output($body);
    }

    public function sitemap()
    {
        $baseUrl = frontend_seo_canonical_base();
        $urls = array('' => '');
        foreach (array_keys(frontend_seo_public_routes()) as $path) {
            if ($path !== '') {
                $urls[$path] = '';
            }
        }

        $posts = $this->db
            ->select('vc_type, uuid, dt_published')
            ->from('tr_posts')
            ->where('vc_status', 1)
            ->where('dt_deleted IS NULL', null, false)
            ->where_in('vc_type', array('berita', 'pers'))
            ->order_by('dt_published', 'DESC')
            ->get()
            ->result_array();

        foreach ($posts as $post) {
            if (empty($post['uuid'])) {
                continue;
            }
            $type = strtolower((string) $post['vc_type']);
            $prefix = $type === 'pers' ? 'Siaran_Pers/' : 'Berita/';
            $path = $prefix . rawurlencode((string) $post['uuid']);
            $urls[$path] = !empty($post['dt_published']) ? date('Y-m-d', strtotime($post['dt_published'])) : '';
        }

        $xml = array(
            '<?xml version="1.0" encoding="UTF-8"?>',
            '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'
        );
        foreach ($urls as $path => $lastModified) {
            $url = $baseUrl . ($path === '' ? '' : $path);
            $xml[] = '  <url><loc>' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8') . '</loc>'
                . ($lastModified !== '' ? '<lastmod>' . $lastModified . '</lastmod>' : '')
                . '</url>';
        }
        $xml[] = '</urlset>';

        $this->output
            ->set_content_type('application/xml', 'utf-8')
            ->set_output(implode("\n", $xml));
    }
}
