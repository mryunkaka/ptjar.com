<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management_Laporan_Keuangan extends CI_Controller
{


    public function __construct() //akan selalu dijalankan ketika akses controlel
    {
        parent::__construct();

        $this->load->model('ManagementLaporanKeuangan_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('global');
        $this->load->helper('text');
        $this->load->library('uuid');

        periksa_login();
    }


    public function index()
    {
        $data['tabtitle'] = 'Management Laporan Keuangan';
        $data['title'] = 'Management Laporan Keuangan';
        $data['url'] = $this->ManagementLaporanKeuangan_model->get_conf_url();
        $data['cnt'] = $this->ManagementLaporanKeuangan_model->count_laporan();



        if (isset($data['cnt'][0])) {
            $cnt = (int) $data['cnt'][0]['cnt'];
        } else {
            $cnt = 0;
        }



        $this->load->library('pagination');
        // $config['base_url'] = base_url() . 'Management_Berita/';
        $config['base_url'] = site_url('Management_Laporan_Keuangan/index');
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

        $data['list'] = $this->ManagementLaporanKeuangan_model->get_laporan_list($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/laporan_keuangan/laporan_keuangan_list');
        $this->load->view('backend/template/main/main_footer');
    }
    public function laporan_form()
    {
        $data['tabtitle'] = 'Management Laporan Keuangan';
        $data['title'] = 'Management Laporan Keuangan';

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/laporan_keuangan/laporan_keuangan_form');
        $this->load->view('backend/template/main/main_footer');
    }

    public function laporan_edit($id)
    {
        $data['tabtitle'] = 'Management Laporan Keuangan';
        $data['title'] = 'Management Laporan Keuangan';

        $data['detail'] = $this->ManagementLaporanKeuangan_model->get_laporan_detail($id);
        $data['url'] = $this->ManagementLaporanKeuangan_model->get_conf_url();

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/laporan_keuangan/laporan_keuangan_edit');
        $this->load->view('backend/template/main/main_footer');
    }















    // CRUD
    public function insert_laporan()
    {
        $this->ManagementLaporanKeuangan_model->insert_laporan();
    }

    public function update_laporan()
    {
        $this->ManagementLaporanKeuangan_model->update_laporan();
    }
    public function get_laporan()
    {
        $this->ManagementLaporanKeuangan_model->get_laporan();
    }
    public function delete_laporan()
    {
        $this->ManagementLaporanKeuangan_model->delete_laporan();
    }
}
