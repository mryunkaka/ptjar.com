<?php

class ManagementPermission_model extends CI_Model
{
    public function get_permission_list()
    {
        $hasil = $this->db->query("SELECT
        a.vc_code_role,
        a.vc_role_name,
        GROUP_CONCAT( c.vc_menu_name ) AS vc_menu 
        FROM
	    mst_role a
	    LEFT JOIN tr_role_menu b ON a.vc_code_role = b.vc_id_role
	    LEFT JOIN mst_menu c ON b.vc_id_menu = c.nu_id
	    GROUP BY a.vc_code_role, a.vc_role_name");
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
            user_account.is_active
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
    public function insert_role()
    {
        $id = $this->input->post('id', TRUE);
        $role_name = $this->input->post('role_name', TRUE);




        if ($id != "" || $role_name != "") {

            $role = $this->db->get_where('mst_role', ['vc_role_name' => $role_name])->num_rows();


            if ($role < 1) {
                $last_role = $this->db->query("SELECT nu_id,vc_code_role from mst_role where nu_id=(SELECT MAX(nu_id)from mst_role)");
                $row = $last_role->result_array();
                $row1 = $row[0]['vc_code_role'] + 1;


                $this->db->trans_start();
                $indata = array(
                    'vc_code_role' =>   $row1,

                    'vc_role_name' => $role_name,

                );
                $daftar =  $this->db->insert('mst_role', $indata);

                $this->db->trans_complete();
                if ($daftar) {
                    $returnData = array(
                        'status' => true,
                        'message' => 'Role Berhasil Didaftarkan',


                    );
                } else {
                    $returnData = array(
                        'status' => false,
                        'message' => 'Role Gagal Didaftarkan',

                    );
                }

                echo json_encode($returnData);
            } else {

                $returnData = array(
                    'status' => false,
                    'message' => 'Role Sudah Terdaftar',

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

    public function get_role_detail($id)
    {

        $hasil = $this->db->query("SELECT
         nu_id, 
         vc_code_role,
         vc_role_name
         FROM
          mst_role 
         WHERE
         vc_code_role=?", array($id));
        return $hasil->result_array();
    }


    public function get_permission_role($id)
    {

        $hasil2 = $this->db->query("SELECT
	    a.nu_id,
		a.vc_id_role,
	    b.vc_menu_name 
      FROM
	    tr_role_menu a
	    LEFT JOIN mst_menu b ON a.vc_id_menu = b.nu_id 
        WHERE
	    a.vc_id_role = ?", array((int) $id));

        return $hasil2->result_array();
    }

    public function get_menu()
    {

        $hasil2 = $this->db->query("SELECT
	    nu_id,
        vc_menu_name 
      FROM
	    mst_menu");

        return $hasil2->result_array();
    }
    public function add_permission()
    {
        $id_role = $this->input->post('id', TRUE);
        $id_permission = $this->input->post('id_permission', TRUE);
        $role = $this->db->get_where('tr_role_menu', ['vc_id_role' => $id_role, 'vc_id_menu' => $id_permission])->num_rows();
        if ($role < 1) {
            $this->db->trans_start();
            $indata = array(

                'vc_id_role' => $id_role,
                'vc_id_menu' => $id_permission,

            );
            $this->db->insert('tr_role_menu', $indata);

            $this->db->trans_complete();
        }
    }

    public function delete_permission()
    {
        $id = $this->input->post('id', TRUE);

        $this->db->where('nu_id', $id);
        $this->db->delete('tr_role_menu');
    }








    // public function update_user()
    // {
    //     $id = $this->input->post('id_update', TRUE);
    //     $password = $this->input->post('password', TRUE);
    //     $role = $this->input->post('role', TRUE);
    //     $sts = $this->input->post('status', TRUE);
    //     $this->db->trans_start();
    //     if ($password == ' ' || $password == null) {
    //         $data = array(
    //             'is_active' => $sts
    //         );
    //     } else {
    //         $data = array(
    //             'is_active' => $sts,
    //             'vc_password' =>  password_hash($password, PASSWORD_DEFAULT),
    //         );
    //     }
    //     $this->db->where('nu_id', $id);
    //     $this->db->update('mst_user', $data);

    //     $akses = array(

    //         'vc_user' => $id,
    //         'vc_role_id' => $role,

    //     );
    //     $this->db->where('vc_user', $id);
    //     $update = $this->db->update('tr_role_akses', $akses);
    //     $this->db->trans_complete();
    //     if ($update) {
    //         $returnData = array(
    //             'status' => true,
    //             'message' => 'User Berhasil Didupdate',
    //             'username' =>  $role

    //         );
    //     } else {
    //         $returnData = array(
    //             'status' => false,
    //             'message' => 'User Gagal Diupdate',

    //         );
    //     }

    //     echo json_encode($returnData);
    // }
}
