<?php

class ManagementCategory_model extends CI_Model
{
    public function get_cat_list()
    {
        $hasil = $this->db->query("SELECT
        * FROM mst_category where vc_post_category='media'");
        return $hasil->result_array();
    }
    public function get_cat_id()
    {
        $id = $this->input->post('id', TRUE);
        $hasil = $this->db->query("SELECT
        * FROM mst_category where nu_id=?", array($id));
        return $hasil->result_array();
    }


    public function insert_category()
    {

        $cat = $this->input->post('cat_name', TRUE);




        if ($cat != "") {

            $row = $this->db->get_where('mst_category', ['vc_category_name' => $cat])->num_rows();


            if ($row < 1) {


                $this->db->trans_start();
                $indata = array(

                    'vc_category_name' =>   $cat,

                );
                $daftar =  $this->db->insert('mst_category', $indata);

                $this->db->trans_complete();
                if ($daftar) {
                    $returnData = array(
                        'status' => true,
                        'message' => 'Kategori Berhasil Didaftarkan',


                    );
                } else {
                    $returnData = array(
                        'status' => false,
                        'message' => 'Kategori Gagal Didaftarkan',

                    );
                }

                echo json_encode($returnData);
            } else {

                $returnData = array(
                    'status' => false,
                    'message' => 'Kategori Sudah Terdaftar',

                );
                echo json_encode($returnData);
            }
        } else {
            $returnData = array(
                'status' => false,
                'message' => 'Data Tidak Boleh Kosong',


            );
            echo json_encode($returnData);
        }
    }




    public function update_category()
    {
        $id = $this->input->post('cat_id', TRUE);
        $cat = $this->input->post('cat_name', TRUE);

        $row = $this->db->get_where('mst_category', ['vc_category_name' => $cat])->num_rows();
        if ($row < 1) {
            $indata = array(

                'vc_category_name' => $cat,

            );
            $this->db->where('nu_id', $id);
            $up = $this->db->update('mst_category', $indata);
            $returnData = array(
                'status' => TRUE,
                'message' => 'Data Berhasil Diupdate',


            );
            echo json_encode($returnData);
        } else {
            $returnData = array(
                'status' => FALSE,
                'message' => 'Data Sudah Ada',


            );
            echo json_encode($returnData);
        }
    }
}
