<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management_User extends CI_Controller
{


    public function __construct() //akan selalu dijalankan ketika akses controlel
    {
        parent::__construct();

        $this->load->model('ManagementUser_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('global');
        periksa_login();
    }

    public function index()
    {
        $data['tabtitle'] = 'Management User';
        $data['title'] = 'Management User';
        $data['role'] = $this->ManagementUser_model->get_role_list();
        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/management/management_user/user_list');
        $this->load->view('backend/template/main/main_footer');
    }


    public function get_user_list()
    {
        $data = $this->ManagementUser_model->get_user_list();
        $returnData = array(
            'status' => true,
            'data' =>  $data,

        );
        echo json_encode($returnData);
    }
    public function get_user_detail()
    {
        $data = $this->ManagementUser_model->get_user_detail();
        $role = $this->ManagementUser_model->get_role_list();
        $returnData = array(
            'status' => true,
            'data' =>  $data,
            'role' =>  $role,


        );
        echo json_encode($returnData);
    }
    public function insert_user()
    {
        $this->ManagementUser_model->insert_user();
    }
    public function update_user()
    {
        $this->ManagementUser_model->update_user();
    }
}
