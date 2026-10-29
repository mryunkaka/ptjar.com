<?php

class ManagementUser_model extends CI_Model
{
    public function get_user_list()
    {
        $hasil = $this->db->query("SELECT
            user_account.nu_id,
            user_account.vc_username,
            user_account.vc_name,
            role.vc_role_name,
            user_account.is_active,
            user_role.vc_role_id
        FROM mst_user AS user_account
        LEFT JOIN tr_role AS user_role ON user_account.nu_id = user_role.vc_user
        LEFT JOIN mst_role AS role ON user_role.vc_role_id = role.vc_code_role
        ORDER BY user_account.nu_id DESC");
        return $hasil->result_array();
    }
    public function get_user_detail()
    {
        $id = $this->input->post('id', TRUE);
        $hasil = $this->db->query("SELECT
            user_account.nu_id,
            user_account.vc_username,
            user_account.vc_name,
            role.vc_role_name,
            user_account.is_active,
            user_role.vc_role_id
        FROM mst_user AS user_account
        LEFT JOIN tr_role AS user_role ON user_account.nu_id = user_role.vc_user
        LEFT JOIN mst_role AS role ON user_role.vc_role_id = role.vc_code_role
        WHERE user_account.nu_id = ?
        LIMIT 1", array($id));
        return $hasil->result_array();
    }

    public function get_role_list()
    {
        $hasil = $this->db->query("SELECT  nu_id,vc_role_name,vc_code_role FROM mst_role");
        return $hasil->result_array();
    }
    public function insert_user()
    {
        $id = $this->session->userdata('id');
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $nama = $this->input->post('nama', TRUE);
        $role = $this->input->post('role', TRUE);
        $sts = $this->input->post('status', TRUE);



        if ($id != "" || $username != "" ||  $nama != "") {

            $user = $this->db->get_where('mst_user', ['vc_username' => $username])->num_rows();


            if ($user < 1) {
                $this->db->trans_start();
                $indata = array(

                    'vc_username' => $username,
                    'vc_password' => password_hash($password, PASSWORD_DEFAULT),
                    'is_active' => $sts,
                    'vc_name' =>  $nama,
                    'vc_created_by' => $id,
                    'dt_created' => date("Y-m-d H:i:s"),

                );
                $this->db->insert('mst_user', $indata);
                $insert_id = $this->db->insert_id();
                $akses = array(

                    'vc_user' => $insert_id,
                    'vc_role_id' => $role,

                );
                $daftar = $this->db->insert('tr_role', $akses);
                $this->db->trans_complete();
                if ($daftar) {
                    $returnData = array(
                        'status' => true,
                        'message' => 'User Berhasil Didaftarkan',
                        'username' =>  $role

                    );
                } else {
                    $returnData = array(
                        'status' => false,
                        'message' => 'User Gagal Didaftarkan',

                    );
                }

                echo json_encode($returnData);
            } else {

                $returnData = array(
                    'status' => false,
                    'message' => 'User Sudah Terdaftar',

                );
                echo json_encode($returnData);
            }
        } else {
            $returnData = array(
                'status' => false,
                'message' => 'Data Tidak Boleh Kosong',
                'username' =>  $username

            );
            echo json_encode($returnData);
        }
    }
    public function update_user()
    {
        $id = $this->input->post('id_update', TRUE);
        $password = $this->input->post('password', TRUE);
        $role = $this->input->post('role', TRUE);
        $sts = $this->input->post('status', TRUE);
        $this->db->trans_start();
        if (trim((string) $password) === '') {
            $data = array(
                'is_active' => $sts
            );
        } else {
            $data = array(
                'is_active' => $sts,
                'vc_password' =>  password_hash($password, PASSWORD_DEFAULT),
            );
        }
        $this->db->where('nu_id', $id);
        $this->db->update('mst_user', $data);

        $akses = array(

            'vc_user' => $id,
            'vc_role_id' => $role,

        );
        $this->db->where('vc_user', $id);
        $update = $this->db->update('tr_role', $akses);
        $this->db->trans_complete();
        if ($update) {
            $returnData = array(
                'status' => true,
                'message' => 'User Berhasil Didupdate',
                'username' =>  $role

            );
        } else {
            $returnData = array(
                'status' => false,
                'message' => 'User Gagal Diupdate',

            );
        }

        echo json_encode($returnData);
    }
}
