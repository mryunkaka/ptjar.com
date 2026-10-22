<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{


    public function __construct() //akan selalu dijalankan ketika akses controlel
    {
        parent::__construct();
        $this->load->model('Dashboard_model');
        $this->load->model('ManagementBerita_model');
        $this->load->model('ManagementSiaranPers_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('global');
        periksa_login();
    }

    public function index()
    {
        $data['tabtitle'] = 'Dashboard';
        $data['title'] = 'Dashboard';
        $data['cnt_berita'] = $this->ManagementBerita_model->count_berita_all();
        $data['cnt_pers'] = $this->ManagementSiaranPers_model->count_berita_all();

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/dashboard/dashboard');
        $this->load->view('backend/template/main/main_footer');
    }
}
