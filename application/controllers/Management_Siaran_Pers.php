<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management_Siaran_Pers extends CI_Controller
{


    public function __construct() //akan selalu dijalankan ketika akses controlel
    {
        parent::__construct();

        $this->load->model('ManagementSiaranPers_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('global');
        $this->load->helper('text');
        $this->load->library('uuid');

        periksa_login();
    }


    public function index()
    {
        $data['tabtitle'] = 'Management Siaran Pers';
        $data['title'] = 'Management Siaran Pers';
        // $data['list'] = $this->ManagementSiaranPers_model->get_berita_list();
        $data['url'] = $this->ManagementSiaranPers_model->get_conf_url_t();
        $data['cnt'] = $this->ManagementSiaranPers_model->count_berita_all();



        if (isset($data['cnt'][0])) {
            $cnt = (int) $data['cnt'][0]['cnt'];
        } else {
            $cnt = 0;
        }



        $this->load->library('pagination');
        // $config['base_url'] = base_url() . 'Management_Siaran/';
        $config['base_url'] = site_url('Management_Siaran/index');
        $config['total_rows'] = $cnt; //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only"></span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 

        $data['list'] = $this->ManagementSiaranPers_model->get_berita_list_all($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();






        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/media/siaran_pers/siaran_pers_list');
        $this->load->view('backend/template/main/main_footer');
    }
    public function berita_form()
    {
        $data['tabtitle'] = 'Management Siaran Pers';
        $data['title'] = 'Management Siaran Pers';
        $data['category'] = $this->ManagementSiaranPers_model->get_category();
        $data['language'] = $this->ManagementSiaranPers_model->get_language();
        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/media/siaran_pers/siaran_pers_form');
        $this->load->view('backend/template/main/main_footer');
    }
    public function berita_preview($id)
    {
        $data['tabtitle'] = 'Management Siaran Pers';
        $data['title'] = 'Management Siaran Pers';
        $data['detail'] = $this->ManagementSiaranPers_model->get_berita_detail($id);
        $data['photo'] = $this->ManagementSiaranPers_model->get_detail_photo($id);
        $data['url'] = $this->ManagementSiaranPers_model->get_conf_url();
        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/media/siaran_pers/siaran_pers_preview');
        $this->load->view('backend/template/main/main_footer');
    }
    public function berita_edit($id)
    {
        $data['tabtitle'] = 'Management Siaran Pers';
        $data['title'] = 'Management Siaran Pers';
        $data['category'] = $this->ManagementSiaranPers_model->get_category();
        $data['detail'] = $this->ManagementSiaranPers_model->get_berita_detail($id);
        $data['tags'] = $this->ManagementSiaranPers_model->get_detail_tags($id);
        $data['photo'] = $this->ManagementSiaranPers_model->get_detail_photo($id);
        $data['url'] = $this->ManagementSiaranPers_model->get_conf_url_t();
        $data['language'] = $this->ManagementSiaranPers_model->get_language();
        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/media/siaran_pers/siaran_pers_edit');
        $this->load->view('backend/template/main/main_footer');
    }















    // CRUD
    public function insert_berita()
    {
        $this->ManagementSiaranPers_model->insert_berita();
    }
    public function insert_berita_preview()
    {
        $this->ManagementSiaranPers_model->insert_berita_preview();
    }
    public function update_berita()
    {
        $this->ManagementSiaranPers_model->update_berita();
    }
    public function get_berita()
    {
        $this->ManagementSiaranPers_model->get_berita();
    }
    public function delete_berita()
    {
        $this->ManagementSiaranPers_model->delete_berita();
    }
    public function delete_berita_preview()
    {
        $this->ManagementSiaranPers_model->delete_berita_preview();
    }
}
