<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management_Tindakan_Korporasi extends CI_Controller
{


    public function __construct() //akan selalu dijalankan ketika akses controlel
    {
        parent::__construct();

        $this->load->model('ManagementTindakanKorporasi_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('global');
        $this->load->helper('text');
        $this->load->library('uuid');

        periksa_login();
    }


    public function index()
    {
        $data['tabtitle'] = 'Management Tindakan Korporasi';
        $data['title'] = 'Management Tindakan Korporasi';
        $data['url'] = $this->ManagementTindakanKorporasi_model->get_conf_url();
        $data['cnt'] = $this->ManagementTindakanKorporasi_model->count_laporan();



        if (isset($data['cnt'][0])) {
            $cnt = (int) $data['cnt'][0]['cnt'];
        } else {
            $cnt = 0;
        }



        $this->load->library('pagination');
        // $config['base_url'] = base_url() . 'Management_Berita/';
        $config['base_url'] = site_url('Management_Tindakan_Korporasi/index');
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

        $data['list'] = $this->ManagementTindakanKorporasi_model->get_laporan_list($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/tindakan_korporasi/tindakan_korporasi_list');
        $this->load->view('backend/template/main/main_footer');
    }
    public function laporan_form()
    {
        $data['tabtitle'] = 'Management Tindakan Korporasi';
        $data['title'] = 'Management Tindakan Korporasi';

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/tindakan_korporasi/tindakan_korporasi_form');
        $this->load->view('backend/template/main/main_footer');
    }

    public function laporan_edit($id)
    {
        $data['tabtitle'] = 'Management Tindakan Korporasi';
        $data['title'] = 'Management Tindakan Korporasi';

        $data['detail'] = $this->ManagementTindakanKorporasi_model->get_laporan_detail($id);
        $data['url'] = $this->ManagementTindakanKorporasi_model->get_conf_url();

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/tindakan_korporasi/tindakan_korporasi_edit');
        $this->load->view('backend/template/main/main_footer');
    }















    // CRUD
    public function insert_laporan()
    {
        $this->ManagementTindakanKorporasi_model->insert_laporan();
    }

    public function update_laporan()
    {
        $this->ManagementTindakanKorporasi_model->update_laporan();
    }
    public function get_laporan()
    {
        $this->ManagementTindakanKorporasi_model->get_laporan();
    }
    public function delete_laporan()
    {
        $this->ManagementTindakanKorporasi_model->delete_laporan();
    }
}
