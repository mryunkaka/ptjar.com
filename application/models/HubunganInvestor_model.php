<?php

class HubunganInvestor_model extends CI_Model
{



    //----------------------------------------------------------------- Informasi Keuangan
    public function get_conf_url_info_keuangan()
    {
        $hasil = $this->db->query("SELECT 
        vc_url From conf_url where vc_cat='laporan_keuangan'");
        return $hasil->result_array();
    }

    public function fornt_get_asset()
    {

        $hasil = $this->db->query("SELECT X.* FROM(SELECT
        vc_tahun,
        vc_cat,
        nu_nominal,
        vc_group_seq AS vc_group_seq 
        FROM
        tr_informasi
        WHERE
        vc_cat = 'asset' 
        AND dt_deleted IS NULL
        and concat(vc_tahun,vc_group_seq) in (select max(concat(vc_tahun,vc_group_seq))  FROM
        tr_informasi WHERE
        vc_cat = 'asset' 
        AND dt_deleted IS NULL
        GROUP BY vc_tahun)	ORDER BY vc_tahun  desc
        limit 5) as X ORDER BY X.vc_tahun ASC

        ");
        return $hasil->result_array();
    }

    public function fornt_get_kewajiban()
    {

        $hasil = $this->db->query("SELECT X.* FROM(SELECT
            vc_tahun,
            vc_cat,
            nu_nominal,
            vc_group_seq AS vc_group_seq 
            FROM
            tr_informasi
            WHERE
            vc_cat = 'kewajiban' 
            AND dt_deleted IS NULL
            and concat(vc_tahun,vc_group_seq) in (select max(concat(vc_tahun,vc_group_seq))  FROM
            tr_informasi WHERE
            vc_cat = 'kewajiban' 
            AND dt_deleted IS NULL
            GROUP BY vc_tahun)	ORDER BY vc_tahun  desc
            limit 5 ) as X ORDER BY X.vc_tahun ASC

        ");
        return $hasil->result_array();
    }

    public function fornt_get_ekuitas()
    {

        $hasil = $this->db->query("SELECT X.* FROM(SELECT
            vc_tahun,
            vc_cat,
            nu_nominal,
            vc_group_seq AS vc_group_seq 
            FROM
            tr_informasi
            WHERE
            vc_cat = 'ekuitas' 
            AND dt_deleted IS NULL
            and concat(vc_tahun,vc_group_seq) in (select max(concat(vc_tahun,vc_group_seq))  FROM
            tr_informasi WHERE
            vc_cat = 'ekuitas' 
            AND dt_deleted IS NULL
            GROUP BY vc_tahun)	ORDER BY vc_tahun  desc
            limit 5 ) as X ORDER BY X.vc_tahun ASC

        ");
        return $hasil->result_array();
    }


    public function fornt_get_laba()
    {

        $hasil = $this->db->query("SELECT X.* FROM(SELECT
            vc_tahun,
            vc_cat,
            nu_nominal,
            vc_group_seq AS vc_group_seq 
            FROM
            tr_informasi
            WHERE
            vc_cat = 'laba' 
            AND dt_deleted IS NULL
            and concat(vc_tahun,vc_group_seq) in (select max(concat(vc_tahun,vc_group_seq))  FROM
            tr_informasi WHERE
            vc_cat = 'laba' 
            AND dt_deleted IS NULL
            GROUP BY vc_tahun)	ORDER BY vc_tahun  desc
            limit 5 ) as X ORDER BY X.vc_tahun ASC

        ");
        return $hasil->result_array();
    }


    // FILE
    public function fornt_get_tahun_file()
    {

        $hasil = $this->db->query("SELECT X.* FROM(SELECT
            vc_tahun 
        FROM
            tr_file_upload 
        WHERE
            vc_cat = 'laporan_keuangan' 
            AND dt_deleted IS NULL 
        GROUP BY
            vc_tahun 
        ORDER BY
            vc_tahun DESC) as X
            Order by X.vc_tahun ASC
        ");
        return $hasil->result_array();
    }

    public function fornt_get_file()
    {

        $hasil = $this->db->query("SELECT
		vc_tahun,vc_url,vc_cat,vc_title_idn,vc_title_eng
	    FROM
		tr_file_upload 
	    WHERE
		vc_cat = 'laporan_keuangan' 
		AND dt_deleted IS NULL 
	    ORDER BY
		vc_tahun DESC, nu_id asc
        ");
        return $hasil->result_array();
    }
    //----------------------------------------------------------------- END Informasi Keuangan

    //-----------------------------------------------------------------Informasi Produksi

    public function fornt_get_tbs()
    {

        $hasil = $this->db->query("SELECT X.* FROM(SELECT
        vc_tahun,
        vc_cat,
        nu_nominal,
        vc_group_seq AS vc_group_seq 
        FROM
        tr_informasi
        WHERE
        vc_cat = 'tbs' 
        AND dt_deleted IS NULL
        and concat(vc_tahun,vc_group_seq) in (select max(concat(vc_tahun,vc_group_seq))  FROM
        tr_informasi WHERE
        vc_cat = 'tbs' 
        AND dt_deleted IS NULL
        GROUP BY vc_tahun)	ORDER BY vc_tahun  desc
        limit 5) as X ORDER BY X.vc_tahun ASC

        ");
        return $hasil->result_array();
    }

    public function fornt_get_cpo()
    {

        $hasil = $this->db->query("SELECT X.* FROM(SELECT
            vc_tahun,
            vc_cat,
            nu_nominal,
            vc_group_seq AS vc_group_seq 
            FROM
            tr_informasi
            WHERE
            vc_cat = 'cpo' 
            AND dt_deleted IS NULL
            and concat(vc_tahun,vc_group_seq) in (select max(concat(vc_tahun,vc_group_seq))  FROM
            tr_informasi WHERE
            vc_cat = 'cpo' 
            AND dt_deleted IS NULL
            GROUP BY vc_tahun)	ORDER BY vc_tahun  desc
            limit 5 ) as X ORDER BY X.vc_tahun ASC

        ");
        return $hasil->result_array();
    }

    public function fornt_get_kernel()
    {

        $hasil = $this->db->query("SELECT X.* FROM(SELECT
            vc_tahun,
            vc_cat,
            nu_nominal,
            vc_group_seq AS vc_group_seq 
            FROM
            tr_informasi
            WHERE
            vc_cat = 'kernel' 
            AND dt_deleted IS NULL
            and concat(vc_tahun,vc_group_seq) in (select max(concat(vc_tahun,vc_group_seq))  FROM
            tr_informasi WHERE
            vc_cat = 'kernel' 
            AND dt_deleted IS NULL
            GROUP BY vc_tahun)	ORDER BY vc_tahun  desc
            limit 5 ) as X ORDER BY X.vc_tahun ASC

        ");
        return $hasil->result_array();
    }


    public function fornt_get_refinery()
    {

        $hasil = $this->db->query("SELECT X.* FROM(SELECT
            vc_tahun,
            vc_cat,
            nu_nominal,
            vc_group_seq AS vc_group_seq 
            FROM
            tr_informasi
            WHERE
            vc_cat = 'refinery' 
            AND dt_deleted IS NULL
            and concat(vc_tahun,vc_group_seq) in (select max(concat(vc_tahun,vc_group_seq))  FROM
            tr_informasi WHERE
            vc_cat = 'refinery' 
            AND dt_deleted IS NULL
            GROUP BY vc_tahun)	ORDER BY vc_tahun  desc
            limit 5 ) as X ORDER BY X.vc_tahun ASC

        ");
        return $hasil->result_array();
    }



    // --------------------------------Rilis Perusahaan
    public function get_conf_url_paparan()
    {
        $hasil = $this->db->query("SELECT 
        vc_url From conf_url where vc_cat='paparan_publik'");
        return $hasil->result_array();
    }
    public function get_conf_url_rupst()
    {
        $hasil = $this->db->query("SELECT 
        vc_url From conf_url where vc_cat='pemegang_saham'");
        return $hasil->result_array();
    }

    public function get_file_paparan_publik()
    {
        $hasil = $this->db->query("SELECT
        nu_id,
	    vc_bulan,
        vc_tahun,
        vc_url,vc_cat,vc_note
        FROM
	    tr_file_upload a
	  
	     WHERE vc_cat='paparan_publik'and dt_deleted IS NULL
       
        ORDER BY
	    vc_tahun DESC,vc_bulan DESC ");
        return $hasil->result_array();
    }
    public function get_file_rupst()
    {
        $hasil = $this->db->query("SELECT
        nu_id,
	    vc_bulan,
        vc_tahun,
        vc_url,vc_cat,vc_note
        FROM
	    tr_file_upload a
	  
	     WHERE vc_cat='pemegang_saham' and dt_deleted IS NULL
       
        ORDER BY
	    vc_tahun DESC,vc_bulan DESC ");
        return $hasil->result_array();
    }
    // --------------------------------END Rilis Perusahaan
    //------------------------------------ RUPS
    public function get_conf_url_rups()
    {
        $hasil = $this->db->query("SELECT 
        vc_url From conf_url where vc_cat='rups'");
        return $hasil->result_array();
    }

    public function fornt_get_tahun_file_rups()
    {

        $hasil = $this->db->query("SELECT X.* FROM(SELECT
            vc_tahun 
        FROM
            tr_file_upload 
        WHERE
            vc_cat = 'rups' 
            AND dt_deleted IS NULL 
        GROUP BY
            vc_tahun 
        ORDER BY
            vc_tahun DESC) as X
            Order by X.vc_tahun ASC
        ");
        return $hasil->result_array();
    }


    public function get_laporan_rups()
    {
        $hasil = $this->db->query("SELECT
        nu_id,
	 
        vc_tahun,
        vc_url,
         vc_title_idn,
                    vc_title_eng,
                    vc_desc_idn,
                    vc_desc_eng,
                    vc_note 
        FROM
	    tr_file_upload a
	  
	     WHERE vc_cat='rups'and dt_deleted IS NULL
       
        ORDER BY
	    vc_tahun DESC,vc_bulan DESC");
        return $hasil->result_array();
    }

    //----------------------------- END RUPS



    // --------------------------------Tindakan Korporasi
    public function get_conf_url_tindakan_korporasi()
    {
        $hasil = $this->db->query("SELECT 
        vc_url From conf_url where vc_cat='tindakan_korporasi'");
        return $hasil->result_array();
    }
    public function get_file_tindakan_korporasi()
    {

        $hasil = $this->db->query("SELECT
        nu_id,
	    vc_bulan,
        vc_tahun,
        vc_url,vc_cat,vc_note,vc_title_idn,vc_title_eng
        FROM
	    tr_file_upload a
	  
	     WHERE vc_cat='tindakan_korporasi' and dt_deleted IS NULL
       
        ORDER BY
	    vc_tahun DESC,vc_bulan DESC ");
        return $hasil->result_array();
    }

    // -------------------------------- EndTindakan Korporasi
    // -------------------------------- Laporan Tahunan
    public function get_conf_url_laporan_tahunan()
    {
        $hasil = $this->db->query("SELECT 
        vc_url From conf_url where vc_cat='laporan_tahunan'");
        return $hasil->result_array();
    }
    public function get_file_laporan_tahunan()
    {

        $hasil = $this->db->query("SELECT
        nu_id,
	    vc_bulan,
        vc_tahun,
        vc_url,vc_cat,vc_note,vc_title_idn,vc_title_eng
        FROM
	    tr_file_upload a
	  
	     WHERE vc_cat='tahun' and dt_deleted IS NULL
       
        ORDER BY
	    vc_tahun DESC,vc_bulan DESC ");
        return $hasil->result_array();
    }

    // -------------------------------- End Laporan Tahunan
    // -------------------------------- Laporan bulan
    public function get_conf_url_laporan_bulanan()
    {
        $hasil = $this->db->query("SELECT 
        vc_url From conf_url where vc_cat='laporan_bulanan'");
        return $hasil->result_array();
    }
    public function get_file_laporan_bulanan()
    {

        $hasil = $this->db->query("SELECT
        nu_id,
	    vc_bulan,
        vc_tahun,
        vc_url,vc_cat,vc_note,vc_title_idn,vc_title_eng
        FROM
	    tr_file_upload a
	  
	     WHERE vc_cat='bulan' and dt_deleted IS NULL
       
        ORDER BY
	    vc_tahun DESC,vc_bulan DESC ");
        return $hasil->result_array();
    }

    // -------------------------------- End Laporan bulan

}
