<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('frontend_seo_canonical_base')) {
    function frontend_seo_canonical_base()
    {
        if (frontend_seo_current_domain() === 'ptjar.co.id') {
            return 'https://ptjar.co.id/';
        }

        return 'https://ptjar.com/';
    }
}

if (!function_exists('frontend_seo_current_domain')) {
    function frontend_seo_current_domain()
    {
        $ci = &get_instance();
        $host = strtolower((string) $ci->input->server('HTTP_HOST'));
        $host = preg_replace('/:\d+$/', '', $host);
        $host = preg_replace('/^www\./', '', $host);

        return in_array($host, array('ptjar.com', 'ptjar.co.id'), true) ? $host : '';
    }
}

if (!function_exists('frontend_seo_public_routes')) {
    function frontend_seo_public_routes()
    {
        return array(
            '' => array(
                'ID' => array('PT Jhonlin Agro Raya Tbk | Sumber Daya Berkelanjutan', 'PT Jhonlin Agro Raya Tbk bergerak di bidang pengolahan kelapa sawit dan turunannya dengan komitmen terhadap pertumbuhan berkelanjutan.'),
                'ENG' => array('PT Jhonlin Agro Raya Tbk | Sustainable Resources', 'PT Jhonlin Agro Raya Tbk processes palm oil and its derivatives with a commitment to sustainable growth.')
            ),
            'Profil_Perusahaan' => array('ID' => array('Profil Perusahaan | PT Jhonlin Agro Raya Tbk', 'Profil, visi, misi, dan informasi perusahaan PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Company Profile | PT Jhonlin Agro Raya Tbk', 'Profile, vision, mission, and company information for PT Jhonlin Agro Raya Tbk.')),
            'Dewan_Komisaris' => array('ID' => array('Dewan Komisaris | PT Jhonlin Agro Raya Tbk', 'Kenali susunan Dewan Komisaris PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Board of Commissioners | PT Jhonlin Agro Raya Tbk', 'Meet the Board of Commissioners of PT Jhonlin Agro Raya Tbk.')),
            'Direksi' => array('ID' => array('Direksi | PT Jhonlin Agro Raya Tbk', 'Kenali susunan Direksi PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Board of Directors | PT Jhonlin Agro Raya Tbk', 'Meet the Board of Directors of PT Jhonlin Agro Raya Tbk.')),
            'Tanggung_Jawab_Dewan_Komisaris' => array('ID' => array('Tanggung Jawab Dewan Komisaris | PT Jhonlin Agro Raya Tbk', 'Tugas dan tanggung jawab Dewan Komisaris PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Board of Commissioners Responsibilities | PT Jhonlin Agro Raya Tbk', 'Duties and responsibilities of the Board of Commissioners.')),
            'Tanggung_Jawab_Direksi' => array('ID' => array('Tanggung Jawab Direksi | PT Jhonlin Agro Raya Tbk', 'Tugas dan tanggung jawab Direksi PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Board of Directors Responsibilities | PT Jhonlin Agro Raya Tbk', 'Duties and responsibilities of the Board of Directors.')),
            'Komite_Audit' => array('ID' => array('Komite Audit | PT Jhonlin Agro Raya Tbk', 'Informasi mengenai Komite Audit PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Audit Committee | PT Jhonlin Agro Raya Tbk', 'Information about the Audit Committee of PT Jhonlin Agro Raya Tbk.')),
            'Sekertaris_Perusahaan' => array('ID' => array('Sekretaris Perusahaan | PT Jhonlin Agro Raya Tbk', 'Informasi dan kontak Sekretaris Perusahaan PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Corporate Secretary | PT Jhonlin Agro Raya Tbk', 'Information and contact details for the Corporate Secretary.')),
            'Struktur_Organisasi' => array('ID' => array('Struktur Organisasi | PT Jhonlin Agro Raya Tbk', 'Struktur organisasi PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Organization Structure | PT Jhonlin Agro Raya Tbk', 'Organization structure of PT Jhonlin Agro Raya Tbk.')),
            'Struktur_Group' => array('ID' => array('Struktur Grup | PT Jhonlin Agro Raya Tbk', 'Struktur grup usaha PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Group Structure | PT Jhonlin Agro Raya Tbk', 'Group structure of PT Jhonlin Agro Raya Tbk.')),
            'Pemegang_Saham' => array('ID' => array('Pemegang Saham | PT Jhonlin Agro Raya Tbk', 'Informasi pemegang saham PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Shareholders | PT Jhonlin Agro Raya Tbk', 'Shareholder information for PT Jhonlin Agro Raya Tbk.')),
            'Area_Kerja' => array('ID' => array('Area Kerja | PT Jhonlin Agro Raya Tbk', 'Informasi area kerja dan operasional PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Operational Areas | PT Jhonlin Agro Raya Tbk', 'Operational areas of PT Jhonlin Agro Raya Tbk.')),
            'Proses_Kerja' => array('ID' => array('Proses Kerja | PT Jhonlin Agro Raya Tbk', 'Pelajari proses kerja dan pengolahan produk PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Our Process | PT Jhonlin Agro Raya Tbk', 'Learn about the operating and production processes of PT Jhonlin Agro Raya Tbk.')),
            'Pencapaian_Perusahaan' => array('ID' => array('Pencapaian Perusahaan | PT Jhonlin Agro Raya Tbk', 'Pencapaian dan perkembangan PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Company Achievements | PT Jhonlin Agro Raya Tbk', 'Achievements and progress of PT Jhonlin Agro Raya Tbk.')),
            'Target_Produksi' => array('ID' => array('Target Produksi | PT Jhonlin Agro Raya Tbk', 'Target dan informasi produksi PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Production Targets | PT Jhonlin Agro Raya Tbk', 'Production targets and information for PT Jhonlin Agro Raya Tbk.')),
            'Berita' => array('ID' => array('Berita | PT Jhonlin Agro Raya Tbk', 'Berita terbaru dan informasi kegiatan PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('News | PT Jhonlin Agro Raya Tbk', 'Latest news and updates from PT Jhonlin Agro Raya Tbk.')),
            'Siaran_Pers' => array('ID' => array('Siaran Pers | PT Jhonlin Agro Raya Tbk', 'Siaran pers resmi PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Press Releases | PT Jhonlin Agro Raya Tbk', 'Official press releases from PT Jhonlin Agro Raya Tbk.')),
            'Informasi_Keuangan' => array('ID' => array('Informasi Keuangan | PT Jhonlin Agro Raya Tbk', 'Laporan dan informasi keuangan PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Financial Information | PT Jhonlin Agro Raya Tbk', 'Financial reports and information for PT Jhonlin Agro Raya Tbk.')),
            'Informasi_Produksi' => array('ID' => array('Informasi Produksi | PT Jhonlin Agro Raya Tbk', 'Informasi dan laporan produksi PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Production Information | PT Jhonlin Agro Raya Tbk', 'Production information and reports for PT Jhonlin Agro Raya Tbk.')),
            'Rilis_Perusahaan' => array('ID' => array('Rilis Perusahaan | PT Jhonlin Agro Raya Tbk', 'Pengumuman dan rilis resmi PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Company Announcements | PT Jhonlin Agro Raya Tbk', 'Official announcements from PT Jhonlin Agro Raya Tbk.')),
            'Rups-Rupslb' => array('ID' => array('RUPS dan RUPSLB | PT Jhonlin Agro Raya Tbk', 'Informasi Rapat Umum Pemegang Saham PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Shareholders Meetings | PT Jhonlin Agro Raya Tbk', 'Shareholders meeting information for PT Jhonlin Agro Raya Tbk.')),
            'Tindakan_Korporasi' => array('ID' => array('Tindakan Korporasi | PT Jhonlin Agro Raya Tbk', 'Informasi tindakan korporasi PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Corporate Actions | PT Jhonlin Agro Raya Tbk', 'Corporate action information for PT Jhonlin Agro Raya Tbk.')),
            'Laporan_Tahunan' => array('ID' => array('Laporan Tahunan | PT Jhonlin Agro Raya Tbk', 'Laporan tahunan PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Annual Reports | PT Jhonlin Agro Raya Tbk', 'Annual reports of PT Jhonlin Agro Raya Tbk.')),
            'Laporan_Bulanan' => array('ID' => array('Laporan Bulanan | PT Jhonlin Agro Raya Tbk', 'Laporan bulanan dan informasi kegiatan PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Monthly Reports | PT Jhonlin Agro Raya Tbk', 'Monthly reports and updates from PT Jhonlin Agro Raya Tbk.')),
            'Kegiatan_Sosial' => array('ID' => array('Kegiatan Sosial | PT Jhonlin Agro Raya Tbk', 'Kegiatan sosial dan kontribusi PT Jhonlin Agro Raya Tbk kepada masyarakat.'), 'ENG' => array('Community Activities | PT Jhonlin Agro Raya Tbk', 'Community programs and contributions by PT Jhonlin Agro Raya Tbk.')),
            'Kebijakan_Kesehatan' => array('ID' => array('Kebijakan Kesehatan dan Keselamatan | PT Jhonlin Agro Raya Tbk', 'Kebijakan kesehatan dan keselamatan kerja PT Jhonlin Agro Raya Tbk.'), 'ENG' => array('Health and Safety Policy | PT Jhonlin Agro Raya Tbk', 'Health and safety policy of PT Jhonlin Agro Raya Tbk.'))
        );
    }
}

if (!function_exists('frontend_seo_current')) {
    function frontend_seo_current($overrides = array())
    {
        $ci = &get_instance();
        $lang = strtoupper((string) $ci->session->userdata('site_lang'));
        $lang = $lang === 'ENG' ? 'ENG' : 'ID';
        $segments = $ci->uri->segment_array();
        $path = implode('/', $segments);
        $routes = frontend_seo_public_routes();
        $firstSegment = isset($segments[0]) ? $segments[0] : '';
        $route = isset($routes[$firstSegment]) ? $routes[$firstSegment] : $routes[''];
        $content = isset($route[$lang]) ? $route[$lang] : $route['ID'];
        $title = $content[0];
        $description = $content[1];
        $robots = 'index,follow';

        if ($firstSegment === 'Search' || (isset($segments[1]) && $segments[1] === 'pages')) {
            $robots = 'noindex,follow';
        }
        if (isset($overrides['title']) && trim((string) $overrides['title']) !== '') {
            $title = (string) $overrides['title'];
        }
        if (isset($overrides['description']) && trim((string) $overrides['description']) !== '') {
            $description = (string) $overrides['description'];
        }
        if (isset($overrides['robots'])) {
            $robots = (string) $overrides['robots'];
        }

        $canonicalPath = $path === '' ? '' : implode('/', array_map('rawurlencode', $segments));
        $canonical = frontend_seo_canonical_base() . $canonicalPath;
        if (isset($overrides['canonical']) && trim((string) $overrides['canonical']) !== '') {
            $canonical = (string) $overrides['canonical'];
        }

        return array(
            'lang' => $lang === 'ENG' ? 'en' : 'id',
            'title' => $title,
            'description' => $description,
            'canonical' => $canonical,
            'robots' => $robots
        );
    }
}
