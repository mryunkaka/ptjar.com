<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend_Hubungan_investor extends CI_Controller
{
    public function __construct() //akan selalu dijalankan ketika akses controlel
    {
        parent::__construct();

        $this->load->model('HubunganInvestor_model');
        $this->load->model('ManagementInformasiProduksi_model');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('login');


        cek_ip();
    }


    public function informasi_keuangan()
    {
        $data['asset'] = $this->HubunganInvestor_model->fornt_get_asset();
        $data['kewajiban'] = $this->HubunganInvestor_model->fornt_get_kewajiban();
        $data['ekuitas'] = $this->HubunganInvestor_model->fornt_get_ekuitas();
        $data['laba'] = $this->HubunganInvestor_model->fornt_get_laba();
        $data['tahun_file'] = $this->HubunganInvestor_model->fornt_get_tahun_file();
        $data['get_file'] = $this->HubunganInvestor_model->fornt_get_file();
        $data['url'] = $this->HubunganInvestor_model->get_conf_url_info_keuangan();

        $this->load->view('frontend/template/header');
        $this->load->view('frontend/template/navbar');
        $this->load->view('frontend/hubungan_investor/informasi_keuangan/informasi_keuangan', $data);
        $this->load->view('frontend/template/footer');
    }
    public function informasi_produksi()
    {
        $data['tbs'] = $this->HubunganInvestor_model->fornt_get_tbs();
        $data['cpo'] = $this->HubunganInvestor_model->fornt_get_cpo();
        $data['kernel'] = $this->HubunganInvestor_model->fornt_get_kernel();
        $data['refinery'] = $this->HubunganInvestor_model->fornt_get_refinery();


        $this->load->view('frontend/template/header');
        $this->load->view('frontend/template/navbar');
        $this->load->view('frontend/hubungan_investor/informasi_produksi/informasi_produksi', $data);
        $this->load->view('frontend/template/footer');
    }
    public function rilis_perusahaan()
    {
        $data['paparan_publik'] = $this->HubunganInvestor_model->get_file_paparan_publik();
        $data['pemegang_saham'] = $this->HubunganInvestor_model->get_file_rupst();
        $data['url_paparan'] = $this->HubunganInvestor_model->get_conf_url_paparan();
        $data['url_rupst'] = $this->HubunganInvestor_model->get_conf_url_rupst();


        $this->load->view('frontend/template/header');
        $this->load->view('frontend/template/navbar');
        $this->load->view('frontend/hubungan_investor/rilis_perusahaan/rilis_perusahaan', $data);
        $this->load->view('frontend/template/footer');
    }
    public function rups()
    {
        $data['list_tahun'] = $this->HubunganInvestor_model->fornt_get_tahun_file_rups();
        $data['rups'] = $this->HubunganInvestor_model->get_laporan_rups();
        $data['url'] = $this->HubunganInvestor_model->get_conf_url_rups();



        $this->load->view('frontend/template/header');
        $this->load->view('frontend/template/navbar');
        $this->load->view('frontend/hubungan_investor/rups/rups', $data);
        $this->load->view('frontend/template/footer');
    }
    public function tindakan_korporasi()
    {
        $data['tindakan_korporasi'] = $this->HubunganInvestor_model->get_file_tindakan_korporasi();

        $data['url'] = $this->HubunganInvestor_model->get_conf_url_tindakan_korporasi();



        $this->load->view('frontend/template/header');
        $this->load->view('frontend/template/navbar');
        $this->load->view('frontend/hubungan_investor/tindakan_korporasi/tindakan_korporasi', $data);
        $this->load->view('frontend/template/footer');
    }
    public function laporan_tahunan()
    {
        $data['laporan_tahunan'] = $this->HubunganInvestor_model->get_file_laporan_tahunan();

        $data['url'] = $this->HubunganInvestor_model->get_conf_url_laporan_tahunan();



        $this->load->view('frontend/template/header');
        $this->load->view('frontend/template/navbar');
        $this->load->view('frontend/hubungan_investor/laporan_tahunan/laporan_tahunan', $data);
        $this->load->view('frontend/template/footer');
    }
    public function laporan_bulanan()
    {
        $data['laporan_bulanan'] = $this->HubunganInvestor_model->get_file_laporan_bulanan();

        $data['url'] = $this->HubunganInvestor_model->get_conf_url_laporan_bulanan();



        $this->load->view('frontend/template/header');
        $this->load->view('frontend/template/navbar');
        $this->load->view('frontend/hubungan_investor/laporan_bulanan/laporan_bulanan', $data);
        $this->load->view('frontend/template/footer');
    }
}
