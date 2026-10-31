<?php

class ManagementSiaranPers_model extends CI_Model
{
    public function get_category()
    {
        $hasil = $this->db->query("SELECT nu_id,vc_category_name FROM mst_category where vc_post_category='media'");
        return $hasil->result_array();
    }
    public function get_language()
    {
        $hasil = $this->db->query("SELECT vc_code,vc_desc FROM conf_language");
        return $hasil->result_array();
    }

    public function get_conf_url_t()
    {
        $hasil = $this->db->query("SELECT 
        vc_url From conf_url where vc_cat='berita_t'");
        return $hasil->result_array();
    }
    public function get_conf_url()
    {
        $hasil = $this->db->query("SELECT 
        vc_url From conf_url where vc_cat='berita'");
        return $hasil->result_array();
    }
    public function get_berita()
    {
        $id = $this->input->post('id', TRUE);
        $hasil = $this->db->query("SELECT vc_title,vc_author_name,uuid FROM tr_posts where uuid=?", array($id));
        $data = $hasil->result_array();
        $returnData = array(
            'status' => TRUE,
            'data' => $data,

        );
        echo json_encode($returnData);
    }

    public function count_berita_all()
    {
        $hasil = $this->db->query("SELECT COUNT(nu_id) as cnt  FROM tr_posts WHERE vc_type='pers'  and dt_deleted IS NULL");
        return $hasil->result_array();
    }
    public function get_berita_list_all($per_page, $awal)
    {
        $hasil = $this->db->query("SELECT
	    a.nu_id,
	    a.uuid,
	    a.vc_type,
	    a.vc_title,
	    a.vc_content,
	    a.vc_author_name,
	    a.vc_status,
	    (
	        SELECT image.vc_image
	        FROM tr_post_images image
	        WHERE image.nu_post_id = a.nu_id
	          AND image.dt_deleted IS NULL
	        ORDER BY image.int_thumbnail DESC, image.nu_id DESC
	        LIMIT 1
	    ) AS vc_image,
	    a.dt_published,
	    a.vc_lang,
	    (
	        SELECT language.vc_img
	        FROM conf_language language
	        WHERE language.vc_code = a.vc_lang
	        LIMIT 1
	    ) AS vc_lang_img
        FROM
	    tr_posts a
        WHERE
	    a.vc_type = 'pers'  and a.dt_deleted IS NULL
        ORDER BY
	    a.dt_published DESC,
	    (SELECT MAX(image.int_thumbnail) FROM tr_post_images image WHERE image.nu_post_id = a.nu_id AND image.dt_deleted IS NULL) DESC
	    LIMIT ? OFFSET ? ", array((int) $per_page, (int) $awal));
        return $hasil->result_array();
    }



    public function count_berita($lang)
    {
        $hasil = $this->db->query("SELECT COUNT(nu_id) as cnt  FROM tr_posts WHERE vc_type='pers' AND vc_lang=? AND vc_status=1 AND dt_deleted IS NULL", array($lang));
        return $hasil->result_array();
    }

    public function get_berita_list($lang, $per_page, $awal)
    {
        $hasil = $this->db->query("SELECT
	    a.nu_id,
	    a.uuid,
	    a.vc_type,
	    a.vc_title,
	    a.vc_content,
	    a.vc_author_name,
	    a.vc_status,
	    (
	        SELECT image.vc_image
	        FROM tr_post_images image
	        WHERE image.nu_post_id = a.nu_id
	          AND image.dt_deleted IS NULL
	        ORDER BY image.int_thumbnail DESC, image.nu_id DESC
	        LIMIT 1
	    ) AS vc_image,
	    a.dt_published,
	    a.vc_lang,
	    (
	        SELECT language.vc_img
	        FROM conf_language language
	        WHERE language.vc_code = a.vc_lang
	        LIMIT 1
	    ) AS vc_lang_img
        FROM
	    tr_posts a
        WHERE
	    a.vc_type = 'pers' and a.vc_lang=? and a.vc_status=1 and a.dt_deleted IS NULL
        ORDER BY
	    a.dt_published DESC,
	    (SELECT MAX(image.int_thumbnail) FROM tr_post_images image WHERE image.nu_post_id = a.nu_id AND image.dt_deleted IS NULL) DESC
	    LIMIT ? OFFSET ? ", array($lang, (int) $per_page, (int) $awal));
        return $hasil->result_array();
    }
    public function get_berita_list_recent($lang)
    {
        $hasil = $this->db->query("SELECT 
        a.nu_id ,
	        a.uuid,
	        a.vc_type,
	        a.vc_title,
	        a.vc_content,
	        a.vc_author_name,
	        a.vc_status,
	        (
	            SELECT image.vc_image
	            FROM tr_post_images image
	            WHERE image.nu_post_id = a.nu_id
	              AND image.dt_deleted IS NULL
	            ORDER BY image.int_thumbnail DESC, image.nu_id DESC
	            LIMIT 1
	        ) AS vc_image,
	        a.dt_published 
        FROM
	        tr_posts a
        WHERE
	        a.vc_type = 'pers' and a.vc_lang=? and a.vc_status=1 and a.dt_deleted IS NULL
        ORDER BY
	a.dt_published DESC LIMIT 4", array($lang));
        return $hasil->result_array();
    }

    public function get_berita_detail($id, $publishedOnly = FALSE)
    {
        $publicFilter = $publishedOnly ? 'AND a.vc_status=1 AND a.dt_deleted IS NULL' : '';
        $hasil = $this->db->query("SELECT
	a.nu_id,
	a.uuid,
	a.vc_type,
	a.vc_category_id,
	a.nu_headline,
	a.vc_title,
	a.vc_content,
	a.vc_author_name,
	a.vc_status,
	b.vc_image,
	a.dt_published,
	d.vc_name,
	d.nu_id AS nu_id_tag ,
    a.vc_lang
    FROM
	tr_posts AS a
	LEFT JOIN tr_post_images AS b ON a.nu_id = b.nu_post_id
	LEFT JOIN tr_post_tag AS c ON a.nu_id = c.vc_post_id
	LEFT JOIN tr_tags AS d ON c.vc_tag_id = d.nu_id 
    WHERE
     a.uuid=? " . $publicFilter, array($id));
        return $hasil->result_array();
    }
    public function get_detail_photo($uuid)
    {
        $id = $this->db->get_where('tr_posts', ['uuid' => $uuid])->row_array();
        $id = $id['nu_id'];

        $hasil = $this->db->query("SELECT*
            FROM
            tr_post_images
           where nu_post_id=? and dt_deleted is null order by int_thumbnail desc", array($id));
        return $hasil->result_array();
    }

    public function get_detail_tags($uuid)
    {
        $id = $this->db->get_where('tr_posts', ['uuid' => $uuid])->row_array();
        $id = $id['nu_id'];
        $hasil = $this->db->query("SELECT
	b.nu_id,
	b.vc_name
    FROM
	tr_post_tag a
	LEFT JOIN tr_tags b on a.vc_tag_id=b.nu_id
    WHERE
	a.vc_post_id = ?
	", array($id));
        return $hasil->result_array();
    }


    function _resizeImage($filename)
    {
        $source_path = './assets/file/backend/upload/berita/image/' .  $filename;

        $target_path = './assets/file/backend/upload/berita/thumbnail';



        $config['image_library'] = 'gd2';
        $config['source_image'] =  $source_path;
        $config['new_image'] =   $target_path;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        $config['thumb_marker'] = FALSE;
        $config['width'] = 800;
        $config['height'] = 600;
        $this->load->library('image_lib', $config);
        $this->image_lib->initialize($config);
        // Do your manipulation

        if (!$this->image_lib->resize()) {
            echo $this->image_lib->display_errors();
        }
        $this->image_lib->clear();
    }

    public function insert_berita_preview()
    {


        $this->load->helper('url');
        $this->load->helper('html');

        $hasils = $this->db->query("SELECT max(nu_id)as pull FROM tr_posts");
        $resu = $hasils->result_array();
        $uuid =  $resu[0]['pull'];
        $bahasa = $this->input->post('bahasa', TRUE);
        $category = $this->input->post('category', TRUE);
        $dt_publish = $this->input->post('dt_publish', TRUE);
        $post_sts = $this->input->post('post_sts', TRUE);

        $berita_author = $this->input->post('berita_author', TRUE);
        $headline_sts = $this->input->post('headline_sts', TRUE);
        if (is_null($headline_sts)) {
            $headline_sts = 0;
        } else {
            $headline_sts = 1;
        }
        $berita_title = $this->input->post('berita_title', TRUE);
        $content_berita = $this->input->post('content_berita', TRUE);
        $meta_keyword = $this->input->post('meta_keyword', TRUE);
        $tumbnail = $this->input->post('tumbnail', TRUE);

        $count = count($_FILES['image_berita']['name']);
        $files = $_FILES;
        $time = date("Y-m-d H:i:s");
        // tags
        $meta_keyword = (explode(",", $meta_keyword));
        if (is_array($meta_keyword)) {
            $meta_keyword = array_filter($meta_keyword);
            $cnt_keyword = count($meta_keyword);
        } else {
            $cnt_keyword = 0;
        }



        // post
        $this->db->trans_start();
        $indata = array(
            'uuid' => $this->uuid->v4($uuid),
            'vc_category_id' => $category,
            'vc_status' => 0,
            'vc_type' => 'pers',
            'nu_headline' => $headline_sts,
            'vc_title' => $berita_title,
            'vc_content' => $content_berita,
            'vc_slug' => slugify($berita_title),
            'vc_author_name' => $berita_author,
            'dt_published' => $dt_publish,
            'dt_updated' => $time,
            'dt_created' => $time,
            'vc_lang' => $bahasa,
        );

        $this->db->insert('tr_posts', $indata);
        $last_id = $this->db->insert_id();






        // image
        for ($i = 0; $i < $count; $i++) {
            if (!file_exists('./assets/file/backend/upload/berita/image')) {
                mkdir('./assets/file/backend/upload/berita/image', 0777, TRUE);
            }
            if ($tumbnail == $i) {
                $tumb = '1';
            } else {
                $tumb = '0';
            }



            if ($files['image_berita']['type'][$i] != '') {
                $_FILES['image_berita']['name'] = $files['image_berita']['name'][$i];
                $_FILES['image_berita']['type'] = $files['image_berita']['type'][$i];
                $_FILES['image_berita']['tmp_name'] = $files['image_berita']['tmp_name'][$i];
                $_FILES['image_berita']['error'] = $files['image_berita']['error'][$i];
                $_FILES['image_berita']['size'] = $files['image_berita']['size'][$i];

                $config['upload_path']          =  './assets/file/backend/upload/berita/image';
                $config['allowed_types']         = 'png|jpg|jpeg'; //'png|jpg|jpeg|gif|bmp';
                $config['overwrite']             = FALSE;
                $config['remove_spaces']         = TRUE;

                $config['max_size']              = '50000'; // in KB    
                $this->load->library('upload', $config);



                if (!$this->upload->do_upload('image_berita')) {
                    $error = array('error' => $this->upload->display_errors());
                    // $this->load->view('imageUploadForm', $error);
                } else {

                    $fileData = $this->upload->data();

                    create_webp_sidecar($fileData['full_path']);
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                    $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
                }




                if (!empty($uploadData)) {
                    $indata = array(
                        'vc_image' =>  $uploadData[$i]['file_name'],
                        'int_thumbnail' => $tumb,
                        'nu_post_id' =>  $last_id,
                        'dt_created' => $time,
                        'dt_updated' => $time,

                    );
                    $this->db->insert('tr_post_images', $indata);
                    $this->_resizeImage($uploadData[$i]['file_name']);
                }
            }
        }

        //tags
        if ($cnt_keyword > 0) {

            for ($i = 0; $i < $cnt_keyword; $i++) {
                $cektags = $this->db->get_where('tr_tags', ['vc_name' => $meta_keyword[$i]])->result_array();
                if (empty($cektags[0])) {

                    $indata = array(
                        'vc_name' => $meta_keyword[$i],
                        'vc_slug' => slugify($meta_keyword[$i]),
                        'nu_count' => 1,
                        'dt_updated' => $time,
                        'dt_created' => $time,
                    );
                    $this->db->insert('tr_tags', $indata);
                    $last_ids = $this->db->insert_id();

                    $indata = array(
                        'vc_post_id' =>   $last_id,
                        'vc_tag_id' =>  $last_ids,
                    );
                    $this->db->insert('tr_post_tag', $indata);
                } else {

                    $update = array(
                        'nu_count' => $cektags[0]['nu_count'] + 1,
                        'dt_updated' => $time,
                    );
                    $this->db->where('nu_id', $cektags[0]['nu_id']);
                    $this->db->update('tr_tags', $update);

                    $indata = array(
                        'vc_post_id' =>  $last_id,
                        'vc_tag_id' => $cektags[0]['nu_id'],
                    );
                    $this->db->insert('tr_post_tag', $indata);
                }
            }
        }
        $cektags = $this->db->get_where('tr_posts', ['nu_id' => $last_id])->result_array();
        $this->db->trans_complete();
        $returnData = array(
            'status' => true,
            'uuid' =>   $cektags[0]['uuid'],

        );


        echo json_encode($returnData);
    }
    public function insert_berita()
    {


        $this->load->helper('url');
        $this->load->helper('html');

        $hasils = $this->db->query("SELECT max(nu_id)as pull FROM tr_posts");
        $resu = $hasils->result_array();
        $uuid =  $resu[0]['pull'];
        $bahasa = $this->input->post('bahasa', TRUE);
        $category = $this->input->post('category', TRUE);
        $dt_publish = $this->input->post('dt_publish', TRUE);
        $post_sts = $this->input->post('post_sts', TRUE);

        $berita_author = $this->input->post('berita_author', TRUE);
        $headline_sts = $this->input->post('headline_sts', TRUE);
        if (is_null($headline_sts)) {
            $headline_sts = 0;
        } else {
            $headline_sts = 1;
        }
        $berita_title = $this->input->post('berita_title', TRUE);
        $content_berita = $this->input->post('content_berita', TRUE);
        $meta_keyword = $this->input->post('meta_keyword', TRUE);
        $tumbnail = $this->input->post('tumbnail', TRUE);

        $count = count($_FILES['image_berita']['name']);
        $files = $_FILES;
        $time = date("Y-m-d H:i:s");
        // tags
        $meta_keyword = (explode(",", $meta_keyword));
        if (is_array($meta_keyword)) {
            $meta_keyword = array_filter($meta_keyword);
            $cnt_keyword = count($meta_keyword);
        } else {
            $cnt_keyword = 0;
        }



        // post
        $this->db->trans_start();
        $indata = array(
            'uuid' => $this->uuid->v4($uuid),
            'vc_category_id' => $category,
            'vc_status' => $post_sts,
            'vc_type' => 'pers',
            'nu_headline' => $headline_sts,
            'vc_title' => $berita_title,
            'vc_content' => $content_berita,
            'vc_slug' => slugify($berita_title),
            'vc_author_name' => $berita_author,
            'dt_published' => $dt_publish,
            'dt_updated' => $time,
            'dt_created' => $time,
            'vc_lang' => $bahasa,
        );

        $this->db->insert('tr_posts', $indata);
        $last_id = $this->db->insert_id();






        // image
        for ($i = 0; $i < $count; $i++) {
            if (!file_exists('./assets/file/backend/upload/berita/image')) {
                mkdir('./assets/file/backend/upload/berita/image', 0777, TRUE);
            }
            if ($i == 0) {
                $tumb = '1';
            } else {
                $tumb = '0';
            }



            if ($files['image_berita']['type'][$i] != '') {
                $_FILES['image_berita']['name'] = $files['image_berita']['name'][$i];
                $_FILES['image_berita']['type'] = $files['image_berita']['type'][$i];
                $_FILES['image_berita']['tmp_name'] = $files['image_berita']['tmp_name'][$i];
                $_FILES['image_berita']['error'] = $files['image_berita']['error'][$i];
                $_FILES['image_berita']['size'] = $files['image_berita']['size'][$i];

                $config['upload_path']          =  './assets/file/backend/upload/berita/image';
                $config['allowed_types']         = 'png|jpg|jpeg'; //'png|jpg|jpeg|gif|bmp';
                $config['overwrite']             = FALSE;
                $config['remove_spaces']         = TRUE;

                $config['max_size']              = '50000'; // in KB    
                $this->load->library('upload', $config);



                if (!$this->upload->do_upload('image_berita')) {
                    $error = array('error' => $this->upload->display_errors());
                    // $this->load->view('imageUploadForm', $error);
                } else {

                    $fileData = $this->upload->data();

                    create_webp_sidecar($fileData['full_path']);
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                    $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
                }




                if (!empty($uploadData)) {
                    $indata = array(
                        'vc_image' =>  $uploadData[$i]['file_name'],
                        'int_thumbnail' => $tumb,
                        'nu_post_id' =>  $last_id,
                        'dt_created' => $time,
                        'dt_updated' => $time,

                    );
                    $this->db->insert('tr_post_images', $indata);
                    $this->_resizeImage($uploadData[$i]['file_name']);
                }
            }
        }

        //tags
        if ($cnt_keyword > 0) {

            for ($i = 0; $i < $cnt_keyword; $i++) {
                $cektags = $this->db->get_where('tr_tags', ['vc_name' => $meta_keyword[$i]])->result_array();
                if (empty($cektags[0])) {

                    $indata = array(
                        'vc_name' => $meta_keyword[$i],
                        'vc_slug' => slugify($meta_keyword[$i]),
                        'nu_count' => 1,
                        'dt_updated' => $time,
                        'dt_created' => $time,
                    );
                    $this->db->insert('tr_tags', $indata);
                    $last_ids = $this->db->insert_id();

                    $indata = array(
                        'vc_post_id' =>   $last_id,
                        'vc_tag_id' =>  $last_ids,
                    );
                    $this->db->insert('tr_post_tag', $indata);
                } else {

                    $update = array(
                        'nu_count' => $cektags[0]['nu_count'] + 1,
                        'dt_updated' => $time,
                    );
                    $this->db->where('nu_id', $cektags[0]['nu_id']);
                    $this->db->update('tr_tags', $update);

                    $indata = array(
                        'vc_post_id' =>  $last_id,
                        'vc_tag_id' => $cektags[0]['nu_id'],
                    );
                    $this->db->insert('tr_post_tag', $indata);
                }
            }
        }
        $cektags = $this->db->get_where('tr_posts', ['nu_id' => $last_id])->result_array();
        $this->db->trans_complete();
        $returnData = array(
            'status' => true,
            'uuid' =>   $cektags[0]['uuid'],

        );


        echo json_encode($returnData);
    }


    public function update_berita()
    {


        $this->load->helper('url');
        $this->load->helper('html');

        $uuid = $this->input->post('id_post', TRUE);
        $id = $this->db->get_where('tr_posts', ['uuid' => $uuid])->row_array();
        $id = $id['nu_id'];

        $category = $this->input->post('category', TRUE);
        $dt_publish = $this->input->post('dt_publish', TRUE);
        $post_sts = $this->input->post('post_sts', TRUE);
        $berita_author = $this->input->post('berita_author', TRUE);
        $headline_sts = $this->input->post('headline_sts', TRUE);
        if (is_null($headline_sts)) {
            $headline_sts = 0;
        } else {
            $headline_sts = 1;
        }
        $berita_title = $this->input->post('berita_title', TRUE);
        $content_berita = $this->input->post('content_berita', TRUE);
        $meta_keyword = $this->input->post('meta_keyword', TRUE);

        // image
        // $tumbnail = $this->input->post('tumbnail', TRUE);

        $count = isset($_FILES['image_berita']['name']) ? count($_FILES['image_berita']['name']) : 0;


        $files = $_FILES;
        $time = date("Y-m-d H:i:s");
        // tags
        $meta_keyword = (explode(",", $meta_keyword));
        if (is_array($meta_keyword)) {
            $meta_keyword = array_filter($meta_keyword);
            $cnt_keyword = count($meta_keyword);
        } else {
            $cnt_keyword = 0;
        }

        // delete_image
        $del_img = $this->input->post('del_img', TRUE);
        $del_img = (explode(",", $del_img));
        $cnt_del_img = count($del_img);


        // post
        $this->db->trans_start();
        $udt = array(

            'vc_category_id' => $category,
            'vc_status' => $post_sts,
            'nu_headline' => $headline_sts,
            'vc_title' => $berita_title,
            'vc_content' => $content_berita,
            'vc_slug' => slugify($berita_title),
            'vc_author_name' => $berita_author,
            'dt_published' => $dt_publish,
            'dt_updated' => $time,

        );
        // update
        $this->db->where('uuid', $uuid);
        $this->db->update('tr_posts', $udt);


        // cek image yang dihapus
        for ($i = 0; $i < $cnt_del_img; $i++) {

            $delete = array(
                'dt_deleted' => $time,
            );
            $this->db->where('nu_id', $del_img[$i]);
            $this->db->update('tr_post_images', $delete);
        }

        $old_image = $this->db->get_where('tr_post_images', ['nu_post_id' => $id, 'dt_deleted' => NULL, 'int_thumbnail' => 1])->num_rows();

        for ($i = 0; $i < $count; $i++) {
            if (!file_exists('./assets/file/backend/upload/berita/image')) {
                mkdir('./assets/file/backend/upload/berita/image', 0777, TRUE);
            }

            if ($old_image > 0) {
                $tumb = '0';
            } else {
                if ($i == 0) {
                    $tumb = '1';
                } else {
                    $tumb = '0';
                }
            }


            if ($files['image_berita']['type'][$i] != '') {
                $_FILES['image_berita']['name'] = $files['image_berita']['name'][$i];
                $_FILES['image_berita']['type'] = $files['image_berita']['type'][$i];
                $_FILES['image_berita']['tmp_name'] = $files['image_berita']['tmp_name'][$i];
                $_FILES['image_berita']['error'] = $files['image_berita']['error'][$i];
                $_FILES['image_berita']['size'] = $files['image_berita']['size'][$i];

                $config['upload_path']          =  './assets/file/backend/upload/berita/image';
                $config['allowed_types']         = 'png|jpg|jpeg'; //'png|jpg|jpeg|gif|bmp';
                $config['overwrite']             = FALSE;
                $config['remove_spaces']         = TRUE;

                $config['max_size']              = '50000'; // in KB    
                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image_berita')) {
                    $fileData = $this->upload->data();
                    create_webp_sidecar($fileData['full_path']);
                    $uploadData[$i]['file_name'] = $fileData['file_name'];
                    $uploadData[$i]['created'] = date("Y-m-d H:i:s");
                    $uploadData[$i]['modified'] = date("Y-m-d H:i:s");
                }


                if (!empty($uploadData)) {
                    $indata = array(
                        'vc_image' => $uploadData[$i]['file_name'],
                        'int_thumbnail' => $tumb,
                        'nu_post_id' =>   $id,
                        'dt_created' => $time,
                        'dt_updated' => $time,

                    );
                    $this->db->insert('tr_post_images', $indata);
                    $this->_resizeImage($uploadData[$i]['file_name']);
                }
            }
        }



        //tags cek row input

        if ($cnt_keyword > 0) {


            for ($i = 0; $i < $cnt_keyword; $i++) {



                $cektags = $this->db->get_where('tr_tags', ['vc_name' => $meta_keyword[$i]])->result_array();
                // cek input empty stirng atau bukan
                if (empty($cektags)) {
                    $indata = array(
                        'vc_name' => $meta_keyword[$i],
                        'vc_slug' => slugify($meta_keyword[$i]),
                        'nu_count' => 1,
                        'dt_updated' => $time,
                        'dt_created' => $time,
                    );
                    $this->db->insert('tr_tags', $indata);
                    $last_ids = $this->db->insert_id();
                    $tmp_tag[] = (int) $last_ids;

                    $indata = array(
                        'vc_post_id' => $id,
                        'vc_tag_id' => $last_ids,
                    );
                    $this->db->insert('tr_post_tag', $indata);
                } else {
                    $tag_id = (int) $cektags[0]['nu_id'];
                    $count_tags = (int) $cektags[0]['nu_count'];
                    $tmp_tag[] = $tag_id;
                    //jika empty string
                    //cek di pivot apakah ada ?
                    $cekpivot = $this->db->get_where('tr_post_tag', ['vc_tag_id' => $tag_id, 'vc_post_id' => $id])->result_array();
                    if (empty($cekpivot[0])) {
                        $indata = array(
                            'vc_post_id' => $id,
                            'vc_tag_id' => $tag_id,
                        );
                        $this->db->insert('tr_post_tag', $indata);
                        $this->db->set('nu_count', 'nu_count + 1', FALSE)->where('nu_id', $tag_id)->update('tr_tags');
                    }
                }
            }




            $tagIds = array_values(array_unique(array_map('intval', isset($tmp_tag) ? $tmp_tag : array())));
            $existingTags = $this->db->get_where('tr_post_tag', array('vc_post_id' => $id))->result_array();
            foreach ($existingTags as $existingTag) {
                $existingTagId = (int) $existingTag['vc_tag_id'];
                if (!in_array($existingTagId, $tagIds, TRUE)) {
                    $this->db->where('vc_post_id', $id)->where('vc_tag_id', $existingTagId)->delete('tr_post_tag');
                    $this->db->set('nu_count', 'GREATEST(nu_count - 1, 0)', FALSE)
                        ->where('nu_id', $existingTagId)->update('tr_tags');
                }
            }
        } else {


            $existingTags = $this->db->get_where('tr_post_tag', array('vc_post_id' => $id))->result_array();
            foreach ($existingTags as $existingTag) {
                $existingTagId = (int) $existingTag['vc_tag_id'];
                $this->db->set('nu_count', 'GREATEST(nu_count - 1, 0)', FALSE)
                    ->where('nu_id', $existingTagId)->update('tr_tags');
            }
            $this->db->where('vc_post_id', $id)->delete('tr_post_tag');
        }
        $this->db->trans_complete();
        $returnData = array(
            'status' => TRUE,
            // 'message' => $tumbnail[0],

        );


        echo json_encode($returnData);
    }






    public function delete_berita()
    {
        $uuid = $this->input->post('id_deleted', TRUE);
        $time = date("Y-m-d H:i:s");
        $this->db->trans_start();
        $udt = array(
            'dt_deleted' => $time,
        );
        // updateid_deleted
        $this->db->where('uuid', $uuid);
        $id = $this->db->update('tr_posts', $udt);
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
					<strong> Berita Berhasil Dihapus </strong>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</button>
					</div>');
        echo json_encode($returnData);
    }



    public function delete_berita_preview()
    {
        $uuid = $this->input->post('id_deleted', TRUE);
        $time = date("Y-m-d H:i:s");

        $udt = array(
            'dt_deleted' => $time,
        );
        // updateid_deleted
        $this->db->where('uuid', $uuid);
        $id = $this->db->update('tr_posts', $udt);


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
        			<strong> Berita Berhasil Dihapus </strong>
        			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        			</button>
        			</div>');
        echo json_encode($returnData);
    }
}
