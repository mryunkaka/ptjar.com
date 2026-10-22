<?php

class Global_model extends CI_Model
{
    function update_password()
    {
        $idupdate = $this->session->userdata('id');
        $password = $this->input->post('password', TRUE);




        $data = array(
            'vc_password' =>  password_hash($password, PASSWORD_DEFAULT),
        );
        $this->db->where('nu_id', $idupdate);
        $update = $this->db->update('mst_user', $data);
        if ($update) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil Disimpan</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Gagal Disimpan</div>');
        }
    }
}
