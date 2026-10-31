<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Management_Berita extends CI_Controller
{


    public function __construct() //akan selalu dijalankan ketika akses controlel
    {
        parent::__construct();

        $this->load->model('ManagementBerita_model');
        $this->load->model('Jhonlinmagz_import_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('global');
        $this->load->helper('text');
        $this->load->library('uuid');

        periksa_login();
    }


    public function index()
    {
        $data['tabtitle'] = 'Management Berita';
        $data['title'] = 'Management Berita';
        // $data['list'] = $this->ManagementBerita_model->get_berita_list();
        $data['url'] = $this->ManagementBerita_model->get_conf_url_t();
        $data['cnt'] = $this->ManagementBerita_model->count_berita_all();
        $data['category'] = $this->ManagementBerita_model->get_category();
        $data['language'] = $this->ManagementBerita_model->get_language();
        $data['flash_message'] = $this->session->flashdata('msg');
        $this->session->unset_userdata('msg');



        if (isset($data['cnt'][0])) {
            $cnt = (int) $data['cnt'][0]['cnt'];
        } else {
            $cnt = 0;
        }



        $this->load->library('pagination');
        // $config['base_url'] = base_url() . 'Management_Berita/';
        $config['base_url'] = site_url('Management_Berita/index');
        $config['total_rows'] = $cnt; //total row
        $config['per_page'] = 10;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        // Keep pagination compact so the controls remain usable on small screens.
        $config["num_links"] = 2;

        // Bootstrap pagination with full-size links and a compact page window.
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging admin-pagination"><nav aria-label="Navigasi halaman"><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['attributes']       = array('class' => 'page-link');
        $config['num_tag_open']     = '<li class="page-item">';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link" aria-current="page">';
        $config['cur_tag_close']    = '<span class="visually-hidden"> (halaman aktif)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tag_close']   = '</li>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tag_close']   = '</li>';
        $config['first_tag_open']   = '<li class="page-item">';
        $config['first_tag_close']  = '</li>';
        $config['last_tag_open']    = '<li class="page-item">';
        $config['last_tag_close']   = '</li>';
        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        //panggil function get_mahasiswa_list yang ada pada mmodel mahasiswa_model. 

        $data['list'] = $this->ManagementBerita_model->get_berita_list_all($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();






        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/media/berita/berita_list');
        $this->load->view('backend/template/main/main_footer');
    }
    public function berita_form()
    {
        $data['tabtitle'] = 'Management Berita';
        $data['title'] = 'Management Berita';
        $data['category'] = $this->ManagementBerita_model->get_category();
        $data['language'] = $this->ManagementBerita_model->get_language();
        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/media/berita/berita_form');
        $this->load->view('backend/template/main/main_footer');
    }
    public function berita_preview($id)
    {
        $data['tabtitle'] = 'Management Berita';
        $data['title'] = 'Management Berita';
        $data['detail'] = $this->ManagementBerita_model->get_berita_detail($id);
        $data['photo'] = $this->ManagementBerita_model->get_detail_photo($id);
        $data['url'] = $this->ManagementBerita_model->get_conf_url();
        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/media/berita/berita_preview');
        $this->load->view('backend/template/main/main_footer');
    }
    public function berita_edit($id)
    {
        $data['tabtitle'] = 'Management Berita';
        $data['title'] = 'Management Berita';
        $data['category'] = $this->ManagementBerita_model->get_category();
        $data['detail'] = $this->ManagementBerita_model->get_berita_detail($id);
        $data['tags'] = $this->ManagementBerita_model->get_detail_tags($id);
        $data['photo'] = $this->ManagementBerita_model->get_detail_photo($id);
        $data['url'] = $this->ManagementBerita_model->get_conf_url_t();
        $data['language'] = $this->ManagementBerita_model->get_language();
        $this->load->view('backend/template/main/main_header', $data);
        $this->load->view('backend/template/main/main_sidebar');
        $this->load->view('backend/main/media/berita/berita_edit');
        $this->load->view('backend/template/main/main_footer');
    }















    // CRUD
    public function insert_berita()
    {
        $this->ManagementBerita_model->insert_berita();
    }
    public function insert_berita_preview()
    {
        $this->ManagementBerita_model->insert_berita_preview();
    }
    public function update_berita()
    {
        $this->ManagementBerita_model->update_berita();
    }

    public function publish_berita()
    {
        if ($this->input->method(TRUE) !== 'POST') {
            show_error('Metode permintaan tidak diizinkan.', 405);
        }

        $uuid = trim((string) $this->input->post('uuid', TRUE));
        $published = $this->ManagementBerita_model->publish_draft($uuid);
        if ($published) {
            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">Berita berhasil diposting.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        } else {
            $message = '<div class="alert alert-warning alert-dismissible fade show" role="alert">Draft tidak ditemukan atau sudah diposting.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }

        $this->session->set_flashdata('msg', $message);
        redirect('Management_Berita');
    }

    public function unpublish_berita()
    {
        if ($this->input->method(TRUE) !== 'POST') {
            show_error('Metode permintaan tidak diizinkan.', 405);
        }

        $uuid = trim((string) $this->input->post('uuid', TRUE));
        $unpublished = $this->ManagementBerita_model->unpublish_post($uuid);
        if ($unpublished) {
            $message = '<div class="alert alert-success alert-dismissible fade show" role="alert">Berita berhasil ditarik dari publik dan dikembalikan menjadi Draft.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        } else {
            $message = '<div class="alert alert-warning alert-dismissible fade show" role="alert">Berita terbit tidak ditemukan atau sudah menjadi Draft.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }

        $this->session->set_flashdata('msg', $message);
        redirect('Management_Berita');
    }

    public function get_berita()
    {
        $this->ManagementBerita_model->get_berita();
    }
    public function delete_berita()
    {
        $this->ManagementBerita_model->delete_berita();
    }
    public function delete_berita_preview()
    {
        $this->ManagementBerita_model->delete_berita_preview();
    }

    public function import_from_jhonlinmagz()
    {
        if ($this->input->method(TRUE) !== 'POST') {
            show_error('Metode permintaan tidak diizinkan.', 405);
        }

        $categoryId = (int) $this->input->post('category', TRUE);
        $language = trim((string) $this->input->post('bahasa', TRUE));
        $importAll = $this->input->post('import_scope', TRUE) === 'all';
        if ($importAll) {
            $this->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissible fade show" role="alert">Tarik seluruh arsip perlu JavaScript aktif agar proses bisa dibagi menjadi batch kecil.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            redirect('Management_Berita');
            return;
        }

        try {
            $result = $this->Jhonlinmagz_import_model->import_recent($categoryId, $language);
        } catch (Throwable $error) {
            log_message('error', 'Jhonlin Magazine import request failed: ' . $error->getMessage());
            $result = array('ok' => FALSE, 'error' => 'Terjadi kesalahan saat mengimpor berita. Periksa log aplikasi.');
        }

        if (empty($result['ok'])) {
            $message = '<strong>Impor berita gagal.</strong> ' . html_escape($result['error']);
            $class = 'danger';
        } else {
            $message = '<strong>Impor selesai.</strong> ' .
                (int) $result['imported'] . ' draft baru, ' .
                (int) $result['duplicates'] . ' berita dilewati karena sudah pernah diimpor, dan ' .
                (int) $result['failed'] . ' berita gagal diproses.';
            $class = $result['failed'] > 0 ? 'warning' : 'success';
            if (!empty($result['errors'])) {
                $message .= '<br>' . html_escape(implode(' ', array_slice($result['errors'], 0, 3)));
            }
        }

        $this->session->set_flashdata(
            'msg',
            '<div class="alert alert-' . $class . ' alert-dismissible fade show" role="alert" data-auto-dismiss="10000">' .
                $message .
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
            '</div>'
        );
        redirect('Management_Berita');
    }

    public function import_all_batch()
    {
        if ($this->input->method(TRUE) !== 'POST') {
            show_error('Metode permintaan tidak diizinkan.', 405);
        }

        $page = max(1, (int) $this->input->post('page', TRUE));
        $state = $this->session->userdata('jhonlinmagz_import_state');
        if ($page === 1) {
            $state = array(
                'category' => (int) $this->input->post('category', TRUE),
                'language' => trim((string) $this->input->post('bahasa', TRUE)),
                'next_page' => 1,
                'imported' => 0,
                'duplicates' => 0,
                'failed' => 0,
                'errors' => array(),
            );
        } elseif (!is_array($state) || (int) $state['next_page'] !== $page) {
            $this->send_import_batch_json(array('ok' => FALSE, 'error' => 'Sesi impor tidak ditemukan atau urutan batch tidak valid. Mulai ulang penarikan arsip.'));
            return;
        }

        try {
            $result = $this->Jhonlinmagz_import_model->import_batch(
                $state['category'],
                $state['language'],
                $page,
                1
            );
        } catch (Throwable $error) {
            log_message('error', 'Jhonlin Magazine batch import failed on page ' . $page . ': ' . $error->getMessage());
            $result = array('ok' => FALSE, 'error' => 'Terjadi kesalahan saat menarik batch berita.');
        }

        if (empty($result['ok'])) {
            $this->session->unset_userdata('jhonlinmagz_import_state');
            $this->send_import_batch_json(array(
                'ok' => FALSE,
                'partial' => $page > 1,
                'error' => $result['error'],
            ));
            return;
        }

        $state['imported'] += (int) $result['imported'];
        $state['duplicates'] += (int) $result['duplicates'];
        $state['failed'] += (int) $result['failed'];
        $state['errors'] = array_merge($state['errors'], $result['errors']);

        if (!empty($result['has_more'])) {
            $state['next_page'] = $page + 1;
            $this->session->set_userdata('jhonlinmagz_import_state', $state);
            $this->send_import_batch_json(array(
                'ok' => TRUE,
                'done' => FALSE,
                'page' => $page,
                'total_pages' => (int) $result['total_pages'],
                'imported' => $state['imported'],
                'duplicates' => $state['duplicates'],
                'failed' => $state['failed'],
            ));
            return;
        }

        $message = '<strong>Impor seluruh berita selesai.</strong> ' .
            $state['imported'] . ' draft baru, ' .
            $state['duplicates'] . ' berita dilewati karena sudah pernah diimpor, dan ' .
            $state['failed'] . ' berita gagal diproses.';
        if (!empty($state['errors'])) {
            $message .= '<br>' . html_escape(implode(' ', array_slice($state['errors'], 0, 3)));
        }
        $class = $state['failed'] > 0 ? 'warning' : 'success';
        $this->session->set_flashdata(
            'msg',
            '<div class="alert alert-' . $class . ' alert-dismissible fade show" role="alert" data-auto-dismiss="10000">' .
                $message .
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' .
            '</div>'
        );
        $this->session->unset_userdata('jhonlinmagz_import_state');
        $this->send_import_batch_json(array('ok' => TRUE, 'done' => TRUE));
    }

    private function send_import_batch_json($payload)
    {
        $payload['csrf_name'] = $this->security->get_csrf_token_name();
        $payload['csrf_hash'] = $this->security->get_csrf_hash();
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($payload));
    }
}
