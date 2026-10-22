<?php

class ManagementLaporanKeuangan_model extends CI_Model
{



    public function get_conf_url()
    {
        $hasil = $this->db->query("SELECT 
        vc_url From conf_url where vc_cat='laporan_keuangan'");
        return $hasil->result_array();
    }


    public function count_laporan()
    {
        $hasil = $this->db->query("SELECT COUNT(nu_id) as cnt  FROM tr_file_upload WHERE vc_cat='laporan_keuangan' and dt_deleted IS NULL");
        return $hasil->result_array();
    }
    public function get_laporan()
    {
        $id = $this->input->post('id', TRUE);
        $hasil = $this->db->query("SELECT vc_bulan,vc_tahun,vc_note,nu_id,vc_title_idn,vc_title_eng FROM tr_file_upload where nu_id=?", array($id));
        $data = $hasil->result_array();
        $returnData = array(
            'status' => TRUE,
            'data' => $data,

        );
        echo json_encode($returnData);
    }

    public function get_laporan_list($per_page, $awal)
    {
        $hasil = $this->db->query("SELECT
        nu_id,
	    vc_bulan,
        vc_tahun,
        vc_url,
        vc_title_idn,
        vc_title_eng,vc_note
        FROM
	    tr_file_upload a
	  
	     WHERE vc_cat='laporan_keuangan' and dt_deleted IS NULL
       
        ORDER BY
	    vc_tahun DESC,vc_bulan DESC LIMIT ? OFFSET ? ", array((int) $per_page, (int) $awal));
        return $hasil->result_array();
    }

    public function get_laporan_detail($id)
    {
        $hasil = $this->db->query("SELECT
        nu_id,
        vc_bulan,
        vc_tahun,
        vc_url ,
        vc_title_idn,
        vc_title_eng,vc_note
        FROM tr_file_upload
        WHERE
        nu_id=?", array($id));
        return $hasil->result_array();
    }



    public function insert_laporan()
    {


        $this->load->helper('url');
        $this->load->helper('html');

        $id = $this->session->userdata('id');
        $dt_publish = $this->input->post('dt_publish', TRUE);
        $judul_ind = $this->input->post('judul_ind', TRUE);
        $judul_eng = $this->input->post('judul_eng', TRUE);
        $note = $this->input->post('vc_note', TRUE);

        // $te = getDate(strtotime($dt_publish));
        // $num_padded = sprintf("%02d", $te['mon']);

        $files = $_FILES;
        $time = date("Y-m-d H:i:s");



        $this->db->trans_start();
        if ($files['image_berita']['type'] != '') {
            if (!file_exists('./assets/file/backend/upload/file/laporan_keuangan')) {
                mkdir('./assets/file/backend/upload/file/laporan_keuangan', 0777, TRUE);
            }

            $config['upload_path']          =  './assets/file/backend/upload/file/laporan_keuangan';
            $config['allowed_types']         = 'pdf'; //'png|jpg|jpeg|gif|bmp|zip|rar';
            $config['overwrite']             = FALSE;
            $config['remove_spaces']         = TRUE;

            $config['max_size']              = '50000'; // in KB    
            $this->load->library('upload', $config);



            if (!$this->upload->do_upload('image_berita')) {
                $error = array('error' => $this->upload->display_errors());
            } else {

                $fileData = $this->upload->data();
                $uploadData = $fileData['file_name'];
            }



            if (!empty($uploadData)) {
                $indata = array(


                    'vc_tahun' => $dt_publish,
                    'vc_cat' => 'laporan_keuangan',
                    'vc_url' => $fileData['file_name'],
                    'vc_title_idn' => $judul_ind,
                    'vc_title_eng' => $judul_eng,
                    'vc_note' => $note,

                    'vc_created_by' => $id,
                    'dt_created' => $time,

                );
                $this->db->insert('tr_file_upload', $indata);
                $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Tindakan Korporasi Berhasil Disimpan </strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</button>
					</div>');
            }
        }


        $this->db->trans_complete();


        $returnData = array(
            'status' => true,
            'message' => 'ok',


        );


        echo json_encode($returnData);
    }

    public function update_laporan()
    {


        $this->load->helper('url');
        $this->load->helper('html');


        $id = $this->session->userdata('id');
        $dt_publish = $this->input->post('dt_publish', TRUE);
        $id_update = $this->input->post('id_update', TRUE);
        $judul_ind = $this->input->post('judul_ind', TRUE);
        $judul_eng = $this->input->post('judul_eng', TRUE);
        $vc_note = $this->input->post('vc_note', TRUE);
        // $te = getDate(strtotime($dt_publish));
        // $num_padded = sprintf("%02d", $te['mon']);

        $files = $_FILES;
        $time = date("Y-m-d H:i:s");

        $this->db->trans_start();
        if (!empty($_FILES)) {

            if ($files['image_berita']['type'] != '') {
                $old_image = $this->db->get_where('tr_file_upload', ['nu_id' => $id_update])->result_array();
                unlink('./assets/file/backend/upload/file/laporan_keuangan/' . $old_image[0]['vc_url']);


                $config['upload_path']          =  './assets/file/backend/upload/file/laporan_keuangan';
                $config['allowed_types']         = 'pdf'; //'png|jpg|jpeg|gif|bmp';
                $config['overwrite']             = FALSE;
                $config['remove_spaces']         = TRUE;

                $config['max_size']              = '50000'; // in KB    
                $this->load->library('upload', $config);



                if (!$this->upload->do_upload('image_berita')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {

                    $fileData = $this->upload->data();
                    $uploadData = $fileData['file_name'];
                }



                if (!empty($uploadData)) {
                    $indata = array(



                        'vc_tahun' => $dt_publish,

                        'vc_url' => $fileData['file_name'],
                        'vc_title_idn' => $judul_ind,
                        'vc_title_eng' => $judul_eng,
                        'vc_note' => $vc_note,
                        'vc_updated_by' => $id,

                        'dt_updated' => $time,

                    );
                    $this->db->where('nu_id', $id_update);
                    $this->db->update('tr_file_upload', $indata);
                    $returnData = array(
                        'status' => TRUE,
                        'message' => 'Laporan Berhasil Diupdate',

                    );
                }
            }
        } else {
            $indata = array(

                'vc_tahun' => $dt_publish,
                'vc_title_idn' => $judul_ind,
                'vc_title_eng' => $judul_eng,
                'vc_note' => $vc_note,
                'vc_updated_by' => $id,
                'dt_updated' => $time,

            );
            $this->db->where('nu_id', $id_update);
            $this->db->update('tr_file_upload', $indata);
            $returnData = array(
                'status' => TRUE,
                'message' => 'Laporan Berhasil Diupdate',

            );
        }
        $this->db->trans_complete();
        $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong> Laporan Berhasil Diupdate </strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</button>
					</div>');
        echo json_encode($returnData);
    }

    public function delete_laporan()
    {
        $uuid = $this->input->post('id_deleted', TRUE);
        $time = date("Y-m-d H:i:s");
        $this->db->trans_start();
        $udt = array(
            'dt_deleted' => $time,
        );
        // updateid_deleted
        $this->db->where('nu_id', $uuid);
        $id = $this->db->update('tr_file_upload', $udt);
        $this->db->trans_complete();
        if ($id) {
            $returnData = array(
                'status' => TRUE,
                'message' =>  $uuid,

            );
        } else {
            $returnData = array(
                'status' => FALSE,


            );
        }
        $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong> Tindakan Korporasi Berhasil Dihapus </strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</button>
					</div>');
        echo json_encode($returnData);
    }
}
