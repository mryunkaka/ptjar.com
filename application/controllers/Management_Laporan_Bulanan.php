<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management_Laporan_Bulanan extends CI_Controller
{


    public function __construct() //akan selalu dijalankan ketika akses controlel
    {
        parent::__construct();

        $this->load->model('ManagementLaporanBulanan_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('global');
        $this->load->helper('text');
        $this->load->library('uuid');

        periksa_login();
    }


    public function index()
    {
        $data['tabtitle'] = 'Management Laporan Bulanan';
        $data['title'] = 'Management Laporan Bulanan';
        $data['url'] = $this->ManagementLaporanBulanan_model->get_conf_url();
        $data['cnt'] = $this->ManagementLaporanBulanan_model->count_laporan();



        if (isset($data['cnt'][0])) {
            $cnt = (int) $data['cnt'][0]['cnt'];
        } else {
            $cnt = 0;
        }



        $this->load->library('pagination');
        // $config['base_url'] = base_url() . 'Management_Berita/';
        $config['base_url'] = site_url('Management_Laporan_Bulanan/index');
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

        $data['list'] = $this->ManagementLaporanBulanan_model->get_laporan_list($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/laporan/laporan_bulanan/laporan_bulanan_list');
        $this->load->view('backend/template/main/main_footer');
    }
    public function laporan_form()
    {
        $data['tabtitle'] = 'Management Laporan Bulanan';
        $data['title'] = 'Management Laporan Bulanan';

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/laporan/laporan_bulanan/laporan_bulanan_form');
        $this->load->view('backend/template/main/main_footer');
    }

    public function laporan_edit($id)
    {
        $data['tabtitle'] = 'Management Laporan Bulanan';
        $data['title'] = 'Management Laporan Bulanan';

        $data['detail'] = $this->ManagementLaporanBulanan_model->get_laporan_detail($id);
        $data['url'] = $this->ManagementLaporanBulanan_model->get_conf_url();

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/laporan/laporan_bulanan/laporan_bulanan_edit');
        $this->load->view('backend/template/main/main_footer');
    }















    // CRUD
    public function insert_laporan()
    {
        $this->ManagementLaporanBulanan_model->insert_laporan();
    }
    public function insert_laporan_preview()
    {
        $this->ManagementLaporanBulanan_model->insert_laporan_preview();
    }
    public function update_laporan()
    {
        $this->ManagementLaporanBulanan_model->update_laporan();
    }
    public function get_laporan()
    {
        $this->ManagementLaporanBulanan_model->get_laporan();
    }
    public function delete_laporan()
    {
        $this->ManagementLaporanBulanan_model->delete_laporan();
    }
}
