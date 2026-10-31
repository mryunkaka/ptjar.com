<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management_Rilis_Perusahaan extends CI_Controller
{


    public function __construct() //akan selalu dijalankan ketika akses controlel
    {
        parent::__construct();

        $this->load->model('ManagementRilisPerusahaan_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('global');
        $this->load->helper('text');
        $this->load->library('uuid');

        periksa_login();
    }


    public function index()
    {
        $data['tabtitle'] = 'Management Rilis Perusahaan';
        $data['title'] = 'Management Rilis Perusahaan';
        $data['url_publik'] = $this->ManagementRilisPerusahaan_model->get_conf_url_paparan_publik();
        $data['url_saham'] = $this->ManagementRilisPerusahaan_model->get_conf_url_pemegang_saham();
        $data['cnt'] = $this->ManagementRilisPerusahaan_model->count_rilis_perusahaan();



        if (isset($data['cnt'][0])) {
            $cnt = (int) $data['cnt'][0]['cnt'];
        } else {
            $cnt = 0;
        }



        $this->load->library('pagination');
        // $config['base_url'] = base_url() . 'Management_Berita/';
        $config['base_url'] = site_url('Management_Rilis_Perusahaan/index');
        $config['total_rows'] = $cnt; //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        // Keep pagination compact and consistent across admin lists.
        $config["num_links"] = 2;

        // Bootstrap pagination with full-size links and a compact page window.
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging admin-pagination"><nav aria-label="Navigasi halaman"><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['attributes']       = array('class' => 'page-link');
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link" aria-current="page">';
        $config['cur_tag_close']    = '<span class="visually-hidden"> (halaman aktif)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']   = '</li>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tag_close']  = '</li>';
        $config['last_tag_open']    = '<li class="page-item">';
        $config['last_tag_close']   = '</li>';
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 

        $data['list'] = $this->ManagementRilisPerusahaan_model->get_laporan_list($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/rilis_perusahaan/rilis_perusahaan_list');
        $this->load->view('backend/template/main/main_footer');
    }


    public function paparan_publik_form()
    {
        $data['tabtitle'] = 'Management Paparan Publik';
        $data['title'] = 'Management Paparan Publik';

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/rilis_perusahaan/paparan_publik/paparan_publik_form');
        $this->load->view('backend/template/main/main_footer');
    }

    public function paparan_publik_edit($id)
    {
        $data['tabtitle'] = 'Management Paparan Publik';
        $data['title'] = 'Management Paparan Publik';

        $data['detail'] = $this->ManagementRilisPerusahaan_model->get_laporan_detail($id);
        $data['url'] = $this->ManagementRilisPerusahaan_model->get_conf_url_paparan_publik();

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/rilis_perusahaan/paparan_publik/paparan_publik_edit');
        $this->load->view('backend/template/main/main_footer');
    }




    #PEMEGANG SAHAM

    public function pemegang_saham_form()
    {
        $data['tabtitle'] = 'Management Pemegang Saham Tahunan';
        $data['title'] = 'Management Pemegang Saham Tahunan';

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/rilis_perusahaan/pemegang_saham/pemegang_saham_form');
        $this->load->view('backend/template/main/main_footer');
    }

    public function pemegang_saham_edit($id)
    {
        $data['tabtitle'] = 'Management Laporan Bulanan';
        $data['title'] = 'Management Laporan Bulanan';

        $data['detail'] = $this->ManagementRilisPerusahaan_model->get_laporan_detail($id);
        $data['url'] = $this->ManagementRilisPerusahaan_model->get_conf_url_pemegang_saham();

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/rilis_perusahaan/pemegang_saham/pemegang_saham_edit');
        $this->load->view('backend/template/main/main_footer');
    }












    public function get_rilis_perusahaan()
    {
        $this->ManagementRilisPerusahaan_model->get_rilis_perusahaan();
    }
    public function delete_laporan()
    {

        $this->ManagementRilisPerusahaan_model->delete_laporan();
    }




    // CRUD
    #PAPARAN PUBLIK
    public function insert_laporan_paparan_publik()
    {
        $this->ManagementRilisPerusahaan_model->insert_laporan_paparan_publik();
    }

    public function update_paparan_publik()
    {
        $this->ManagementRilisPerusahaan_model->update_paparan_publik();
    }
    #PEMEGANG SAHAM
    public function insert_laporan_pemegang_saham()
    {
        $this->ManagementRilisPerusahaan_model->insert_laporan_pemegang_saham();
    }

    public function update_pemegang_saham()
    {
        $this->ManagementRilisPerusahaan_model->update_pemegang_saham();
    }
}
