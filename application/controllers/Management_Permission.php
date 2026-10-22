<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management_Permission extends CI_Controller
{


    public function __construct() //akan selalu dijalankan ketika akses controlel
    {
        parent::__construct();

        $this->load->model('ManagementPermission_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('global');
        periksa_login();
    }

    public function index()
    {
        $data['tabtitle'] = 'Management Permission';
        $data['title'] = 'Management Permission';
        $data['role'] = $this->ManagementPermission_model->get_role_list();
        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/management/management_permission/permission_list');
        $this->load->view('backend/template/main/main_footer');
    }


    public function get_permission_list()
    {
        $data = $this->ManagementPermission_model->get_permission_list();
        $returnData = array(
            'status' => true,
            'data' =>  $data,

        );
        echo json_encode($returnData);
    }
    public function get_role_detail()
    {
        $id = $this->input->post('role', TRUE);
        $data = $this->ManagementPermission_model->get_role_detail($id);
        $permission = $this->ManagementPermission_model->get_permission_role($id);
        $menu = $this->ManagementPermission_model->get_menu();
        $returnData = array(
            'status' => true,
            'data' =>  $data,
            'permission' =>  $permission,
            'menu' =>  $menu,


        );
        echo json_encode($returnData);
    }
    public function insert_role()
    {
        $this->ManagementPermission_model->insert_role();
    }

    public function add_permission()
    {
        $id = $this->input->post('id', TRUE);
        $this->ManagementPermission_model->add_permission();
        $permission = $this->ManagementPermission_model->get_permission_role($id);
        $returnData = array(
            'status' => true,
            'permission' => $permission,
        );
        echo json_encode($returnData);
    }
    public function delete_permission()
    {
        $id = $this->input->post('id_role', TRUE);
        $this->ManagementPermission_model->delete_permission();
        $permission = $this->ManagementPermission_model->get_permission_role($id);
        $returnData = array(
            'status' => true,
            'permission' => $permission,
        );
        echo json_encode($returnData);
    }
}
