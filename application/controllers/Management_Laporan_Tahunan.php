<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management_Laporan_Tahunan extends CI_Controller
{


    public function __construct() //akan selalu dijalankan ketika akses controlel
    {
        parent::__construct();

        $this->load->model('ManagementLaporanTahunan_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('global');
        $this->load->helper('text');
        $this->load->library('uuid');

        periksa_login();
    }


    public function index()
    {
        $data['tabtitle'] = 'Management Laporan Tahunan';
        $data['title'] = 'Management Laporan Tahunan';
        $data['url'] = $this->ManagementLaporanTahunan_model->get_conf_url();
        $data['cnt'] = $this->ManagementLaporanTahunan_model->count_laporan();



        if (isset($data['cnt'][0])) {
            $cnt = (int) $data['cnt'][0]['cnt'];
        } else {
            $cnt = 0;
        }



        $this->load->library('pagination');
        // $config['base_url'] = base_url() . 'Management_Berita/';
        $config['base_url'] = site_url('Management_Laporan_Tahunan/index');
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

        $data['list'] = $this->ManagementLaporanTahunan_model->get_laporan_list($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/laporan/laporan_tahunan/laporan_tahunan_list');
        $this->load->view('backend/template/main/main_footer');
    }
    public function laporan_form()
    {
        $data['tabtitle'] = 'Management Laporan Tahunan';
        $data['title'] = 'Management Laporan Tahunan';

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/laporan/laporan_tahunan/laporan_tahunan_form');
        $this->load->view('backend/template/main/main_footer');
    }

    public function laporan_edit($id)
    {
        $data['tabtitle'] = 'Management Laporan Tahunan';
        $data['title'] = 'Management Laporan Tahunan';

        $data['detail'] = $this->ManagementLaporanTahunan_model->get_laporan_detail($id);
        $data['url'] = $this->ManagementLaporanTahunan_model->get_conf_url();

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/laporan/laporan_tahunan/laporan_tahunan_edit');
        $this->load->view('backend/template/main/main_footer');
    }















    // CRUD
    public function insert_laporan()
    {
        $this->ManagementLaporanTahunan_model->insert_laporan();
    }
    public function insert_laporan_preview()
    {
        $this->ManagementLaporanTahunan_model->insert_laporan_preview();
    }
    public function update_laporan()
    {
        $this->ManagementLaporanTahunan_model->update_laporan();
    }
    public function get_laporan()
    {
        $this->ManagementLaporanTahunan_model->get_laporan();
    }
    public function delete_laporan()
    {
        $this->ManagementLaporanTahunan_model->delete_laporan();
    }
}
