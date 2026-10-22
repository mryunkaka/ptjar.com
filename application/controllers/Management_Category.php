<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management_Category extends CI_Controller
{


    public function __construct() //akan selalu dijalankan ketika akses controlel
    {
        parent::__construct();

        $this->load->model('ManagementCategory_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('global');
        periksa_login();
    }

    public function index()
    {
        $data['tabtitle'] = 'Management Category';
        $data['title'] = 'Management Category';

        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/management/management_category/category_list');
        $this->load->view('backend/template/main/main_footer');
    }


    public function get_category_list()
    {
        $data = $this->ManagementCategory_model->get_cat_list();
        $returnData = array(
            'status' => true,
            'data' =>  $data,

        );
        echo json_encode($returnData);
    }



    public function insert_category()
    {
        $this->ManagementCategory_model->insert_category();
    }
    public function get_category_id()
    {
        $data = $this->ManagementCategory_model->get_cat_id();
        $returnData = array(
            'status' => true,
            'data' =>  $data,

        );
        echo json_encode($returnData);
    }

    public function update_category()
    {
        $this->ManagementCategory_model->update_category();
    }
}
