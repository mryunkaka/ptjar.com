<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend_Media extends CI_Controller
{

    public function __construct() //akan selalu dijalankan ketika akses controlel
    {
        parent::__construct();

        $this->load->model('ManagementBerita_model');
        $this->load->model('ManagementSiaranPers_model');
        $this->load->model('ManagementMedia_model');
        $this->load->helper('url');
        $this->load->helper('global');
        $this->load->helper('text');
        cek_ip();
    }


    // Search
    public function search()
    {
        $data['tabtitle'] = 'Management Berita';
        $data['title'] = 'Management Berita';
        $search = trim((string) $this->input->post('search', TRUE));
        $search = function_exists('mb_substr') ? mb_substr($search, 0, 200, 'UTF-8') : substr($search, 0, 200);

        $lang = $this->session->userdata('site_lang');
        if (!in_array($lang, array('ID', 'ENG'), TRUE)) {
            $lang = 'ID';
        }

        $data['url'] = $this->ManagementBerita_model->get_conf_url_t();
        $data['cnt'] = $this->ManagementMedia_model->count_media($lang, $search);
        $data['list_recent'] = $this->ManagementBerita_model->get_berita_list_recent($lang);
        if (isset($data['cnt'][0])) {
            $cnt = (int) $data['cnt'][0]['cnt'];
        } else {
            $cnt = 0;
        }

        if ($lang == 'ID') {
            $data['judul'] = 'Pencarian';
            $data['result'] = $cnt . ' Hasil pencarian untuk"' . html_escape($search) . '"';
        } else {
            $data['judul'] = 'Search';
            $data['result'] = $cnt . ' Result for"' . html_escape($search) . '"';
        }


        $this->load->library('pagination');

        $config['base_url'] = site_url('Berita/pages');
        $config['total_rows'] = $cnt; //total row
        $config['per_page'] = 4;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);


        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="blog-pagination"><ul class="justify-content-center">';
        $config['full_tag_close']   = '</ul></div>';
        $config['num_tag_open']     = '<li><span class="nav-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="nav-link active"><span class="nav-link">';
        $config['cur_tag_close']    = '</span></li>';
        $config['next_tag_open']    = '<li><span class="nav-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li><span class="nav-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li><span class="nav-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li><span class="nav-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 

        $data['list'] = $this->ManagementMedia_model->get_berita_list($lang, $search, $config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();


        $this->load->view('frontend/template/header', $data);
        $this->load->view('frontend/template/navbar');
        $this->load->view('frontend/media/search/search_list');
        $this->load->view('frontend/template/footer');
    }


    // Berita
    public function news()
    {
        $data['tabtitle'] = 'Management Berita';
        $data['title'] = 'Management Berita';
        $lang = $this->session->userdata('site_lang');
        $data['url'] = $this->ManagementBerita_model->get_conf_url_t();
        $data['cnt'] = $this->ManagementBerita_model->count_berita($lang);
        $data['list_recent'] = $this->ManagementBerita_model->get_berita_list_recent($lang);
        if (isset($data['cnt'][0])) {
            $cnt = (int) $data['cnt'][0]['cnt'];
        } else {
            $cnt = 0;
        }



        $this->load->library('pagination');

        $config['base_url'] = site_url('Berita/pages');
        $config['total_rows'] = $cnt; //total row
        $config['per_page'] = 4;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);


        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="blog-pagination"><ul class="justify-content-center">';
        $config['full_tag_close']   = '</ul></div>';
        $config['num_tag_open']     = '<li><span class="nav-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="nav-link active"><span class="nav-link">';
        $config['cur_tag_close']    = '</span></li>';
        $config['next_tag_open']    = '<li><span class="nav-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li><span class="nav-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li><span class="nav-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li><span class="nav-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 

        $data['list'] = $this->ManagementBerita_model->get_berita_list($lang, $config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();




        $this->load->view('frontend/template/header', $data);
        $this->load->view('frontend/template/navbar');
        $this->load->view('frontend/media/berita/berita_list');
        $this->load->view('frontend/template/footer');
    }
    public function news_detail($id)
    {
        $data['tabtitle'] = 'Management Berita';
        $data['title'] = 'Management Berita';
        $lang = $this->session->userdata('site_lang');
        $data['detail'] = $this->ManagementBerita_model->get_berita_detail($id, TRUE);
        if (empty($data['detail'])) {
            show_404();
            return;
        }
        $postTitle = trim(html_entity_decode(strip_tags((string) $data['detail'][0]['vc_title']), ENT_QUOTES, 'UTF-8'));
        $postDescription = $this->seo_excerpt(isset($data['detail'][0]['vc_content']) ? $data['detail'][0]['vc_content'] : '');
        $data['seo_meta'] = array(
            'title' => $postTitle . ' | PT Jhonlin Agro Raya Tbk',
            'description' => $postDescription,
            'canonical' => frontend_seo_canonical_base() . 'Berita/' . rawurlencode((string) $id)
        );
        $data['photo'] = $this->ManagementBerita_model->get_detail_photo($id);
        $data['url'] = $this->ManagementBerita_model->get_conf_url();
        $data['list_recent'] = $this->ManagementBerita_model->get_berita_list_recent($lang);

        $this->load->view('frontend/template/header', $data);
        $this->load->view('frontend/template/navbar');
        $this->load->view('frontend/media/berita/berita_detail');
        $this->load->view('frontend/template/footer');
    }


    #PERS
    public function pers()
    {
        $data['tabtitle'] = 'Management Berita';
        $data['title'] = 'Management Berita';
        $lang = $this->session->userdata('site_lang');
        $data['url'] = $this->ManagementSiaranPers_model->get_conf_url_t();
        $data['cnt'] = $this->ManagementSiaranPers_model->count_berita($lang);
        $data['list_recent'] = $this->ManagementSiaranPers_model->get_berita_list_recent($lang);
        if (isset($data['cnt'][0])) {
            $cnt = (int) $data['cnt'][0]['cnt'];
        } else {
            $cnt = 0;
        }



        $this->load->library('pagination');

        $config['base_url'] = site_url('Siaran_Pers/pages');
        $config['total_rows'] = $cnt; //total row
        $config['per_page'] = 4;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);


        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="blog-pagination"><ul class="justify-content-center">';
        $config['full_tag_close']   = '</ul></div>';
        $config['num_tag_open']     = '<li><span class="nav-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="nav-link active"><span class="nav-link">';
        $config['cur_tag_close']    = '</span></li>';
        $config['next_tag_open']    = '<li><span class="nav-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li><span class="nav-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li><span class="nav-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li><span class="nav-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 

        $data['list'] = $this->ManagementSiaranPers_model->get_berita_list($lang, $config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();




        $this->load->view('frontend/template/header', $data);
        $this->load->view('frontend/template/navbar');
        $this->load->view('frontend/media/siaran_pers/siaran_pers_list');
        $this->load->view('frontend/template/footer');
    }
    public function pers_detail($id)
    {
        $data['tabtitle'] = 'Management Berita';
        $data['title'] = 'Management Berita';
        $lang = $this->session->userdata('site_lang');
        $data['detail'] = $this->ManagementSiaranPers_model->get_berita_detail($id);
        if (empty($data['detail'])) {
            show_404();
            return;
        }
        $postTitle = trim(html_entity_decode(strip_tags((string) $data['detail'][0]['vc_title']), ENT_QUOTES, 'UTF-8'));
        $postDescription = $this->seo_excerpt(isset($data['detail'][0]['vc_content']) ? $data['detail'][0]['vc_content'] : '');
        $data['seo_meta'] = array(
            'title' => $postTitle . ' | PT Jhonlin Agro Raya Tbk',
            'description' => $postDescription,
            'canonical' => frontend_seo_canonical_base() . 'Siaran_Pers/' . rawurlencode((string) $id)
        );
        $data['photo'] = $this->ManagementSiaranPers_model->get_detail_photo($id);
        $data['url'] = $this->ManagementSiaranPers_model->get_conf_url();
        $data['list_recent'] = $this->ManagementSiaranPers_model->get_berita_list_recent($lang);

        $this->load->view('frontend/template/header', $data);
        $this->load->view('frontend/template/navbar');
        $this->load->view('frontend/media/siaran_pers/siaran_pers_detail');
        $this->load->view('frontend/template/footer');
    }

    private function seo_excerpt($content)
    {
        $plainText = trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags((string) $content), ENT_QUOTES, 'UTF-8')));
        if ($plainText === '') {
            return 'Berita dan informasi resmi dari PT Jhonlin Agro Raya Tbk.';
        }
        return function_exists('mb_substr') ? mb_substr($plainText, 0, 155, 'UTF-8') : substr($plainText, 0, 155);
    }
}
