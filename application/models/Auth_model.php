<?php

class Auth_model extends CI_Model
{
    public function get_budget_list()
    {
        $hasil = $this->db->query("SELECT * FROM mst_budget");
        return $hasil->result_array();
    }

    public function get_menu_list($id)
    {
        $hasil = $this->db->query("SELECT vc_role_name 
        FROM tr_role_akses_menu a 
        LEFT JOIN mst_role_menu b on a.vc_menu_code=b.vc_role_code
        WHERE
        vc_user=?
        ", array($id));


        return  $hasil->result_array();
    }
}
