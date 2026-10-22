<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct() //akan selalu dijalankan ketika akses controlel
    {
        parent::__construct();


        $this->load->model('Global_model');
        $this->load->model('Budget_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('global');
        periksa_login();
    }
    public function index()
    {

        $data['title'] = 'Edit Password';
        $this->load->view('template/main/main_header', $data);
        $this->load->view('template/main/main_sidebar');
        $this->load->view('main/user/user_setting');
        $this->load->view('template/main/main_footer');
    }

    public function update_password()
    {
        $this->User_model->update_password();
        redirect('User');
    }
}
