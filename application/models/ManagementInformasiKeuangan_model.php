<?php

class ManagementInformasiKeuangan_model extends CI_Model
{


    public function get_conf_url()
    {
        $hasil = $this->db->query("SELECT 
        vc_url From conf_url where vc_cat='laporan_keuangan'");
        return $hasil->result_array();
    }


    public function count_laporan()
    {
        $hasil = $this->db->query("SELECT
	    COUNT(DISTINCT vc_group_seq) as cnt
        FROM
	    tr_informasi 
	 WHERE
	    dt_deleted IS NULL  and vc_group='keuangan'");
        return $hasil->result_array();
    }
    public function get_laporan()
    {
        $id = $this->input->post('id', TRUE);
        $hasil = $this->db->query("SELECT vc_bulan,vc_tahun,vc_group_seq FROM tr_informasi where vc_group_seq=?", array($id));
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
	    MAX(vc_tahun) AS vc_tahun,
	    vc_group_seq 
        FROM
	    tr_informasi 
        WHERE dt_deleted IS NULL and vc_group='keuangan'
        GROUP BY
	    vc_group_seq 
      
       
        ORDER BY
	    vc_group_seq DESC LIMIT ? OFFSET ? ", array((int) $per_page, (int) $awal));
        return $hasil->result_array();
    }

    public function get_laporan_detail($id)
    {
        $hasil = $this->db->query("SELECT
     
	    nu_id AS nu_id,
	    vc_bulan AS vc_bulan,
	    vc_tahun AS vc_tahun,
	    nu_nominal AS nu_nominal,
	    vc_cat AS vc_cat,
	    vc_group_seq AS vc_group_seq 
        FROM
	    tr_informasi
        WHERE
        vc_group_seq=?", array($id));
        return $hasil->result_array();
    }



    public function insert_laporan()
    {


        $this->load->helper('url');
        $this->load->helper('html');

        $id = $this->session->userdata('id');
        $dt_publish = $this->input->post('dt_publish', TRUE);
        $asset = $this->input->post('asset', TRUE);
        $asset = str_replace(',', '', $asset);
        $kewajiban = $this->input->post('kewajiban', TRUE);
        $kewajiban = str_replace(',', '', $kewajiban);
        $ekuitas = $this->input->post('ekuitas', TRUE);
        $ekuitas = str_replace(',', '', $ekuitas);
        $laba = $this->input->post('laba', TRUE);
        $laba = str_replace(',', '', $laba);

        $time = date("Y-m-d H:i:s");
        $group = 'keuangan';


        $this->db->trans_start();

        $this->db->select_max('vc_group_seq', 'seq');
        $query = $this->db->get('tr_informasi');
        $max = $query->result_array();
        if ($max[0]['seq'] == NULL) {
            $max = 0;
        } else {
            $max = $max[0]['seq'] + 1;
        }



        $indata = array(

            'vc_tahun' =>  $dt_publish,
            'vc_cat' => 'asset',
            'nu_nominal' =>  $asset,
            'vc_created_by' => $id,
            'vc_group' => $group,
            'dt_created' => $time,
            'vc_group_seq' => $max

        );
        $this->db->insert('tr_informasi', $indata);
        $indata = array(

            'vc_tahun' => $dt_publish,
            'vc_cat' => 'kewajiban',
            'nu_nominal' => $kewajiban,
            'vc_created_by' => $id,
            'vc_group' => $group,
            'dt_created' => $time,
            'vc_group_seq' => $max

        );
        $this->db->insert('tr_informasi', $indata);
        $indata = array(

            'vc_tahun' =>  $dt_publish,
            'vc_cat' => 'ekuitas',
            'nu_nominal' => $ekuitas,
            'vc_created_by' => $id,
            'vc_group' => $group,
            'dt_created' => $time,
            'vc_group_seq' => $max

        );
        $this->db->insert('tr_informasi', $indata);
        $indata = array(

            'vc_tahun' =>  $dt_publish,
            'vc_cat' => 'laba',
            'nu_nominal' => $laba,
            'vc_created_by' => $id,
            'vc_group' => $group,
            'dt_created' => $time,
            'vc_group_seq' => $max

        );
        $this->db->insert('tr_informasi', $indata);


        $this->db->trans_complete();


        $returnData = array(
            'status' => true,
            'gg' => $max,


        );
        $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong>Laporan Berhasil Disimpan </strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</button>
					</div>');
        echo json_encode($returnData);
    }

    public function update_laporan()
    {


        $this->load->helper('url');
        $this->load->helper('html');


        $id = $this->session->userdata('id');

        $dt_publish = $this->input->post('dt_publish', TRUE);

        $id_asset = $this->input->post('id_asset', TRUE);
        $asset = $this->input->post('asset', TRUE);
        $asset = str_replace(',', '', $asset);


        $id_kewajiban = $this->input->post('id_kewajiban', TRUE);
        $kewajiban = $this->input->post('kewajiban', TRUE);
        $kewajiban = str_replace(',', '', $kewajiban);


        $id_ekuitas = $this->input->post('id_ekuitas', TRUE);
        $ekuitas = $this->input->post('ekuitas', TRUE);
        $ekuitas = str_replace(',', '', $ekuitas);

        $id_laba = $this->input->post('id_laba', TRUE);
        $laba = $this->input->post('laba', TRUE);
        $laba = str_replace(',', '', $laba);

        $time = date("Y-m-d H:i:s");
        $this->db->trans_start();
        $indata1 = array(

            'vc_tahun' =>  $dt_publish,

            'nu_nominal' =>  $asset,
            'vc_updated_by' => $id,
            'dt_updated' => $time,

        );
        $this->db->where('nu_id', $id_asset);
        $this->db->update('tr_informasi', $indata1);

        $indata2 = array(

            'vc_tahun' =>  $dt_publish,

            'nu_nominal' =>  $kewajiban,
            'vc_updated_by' => $id,
            'dt_updated' => $time,

        );
        $this->db->where('nu_id', $id_kewajiban);
        $this->db->update('tr_informasi', $indata2);

        $indata3 = array(

            'vc_tahun' =>  $dt_publish,

            'nu_nominal' =>  $ekuitas,
            'vc_updated_by' => $id,
            'dt_updated' => $time,

        );
        $this->db->where('nu_id', $id_ekuitas);
        $this->db->update('tr_informasi', $indata3);

        $indata4 = array(

            'vc_tahun' =>  $dt_publish,

            'nu_nominal' =>  $laba,
            'vc_updated_by' => $id,
            'dt_updated' => $time,

        );
        $this->db->where('nu_id', $id_laba);
        $this->db->update('tr_informasi', $indata4);





        $this->db->trans_complete();
        $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
					<strong> Laporan Berhasil Diupdate </strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</button>
					</div>');
        $returnData = array(
            'status' => TRUE,


        );
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
        $this->db->where('vc_group_seq', $uuid);
        $id = $this->db->update('tr_informasi', $udt);
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
					<strong>Laporan Berhasil Dihapus </strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</button>
					</div>');
        echo json_encode($returnData);
    }
}
