<?php
defined('BASEPATH') or exit('No direct script access allowed');
ob_start();
class Auth extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() //akan selalu dijalankan ketika akses controlel
	{
		parent::__construct();

		// $this->load->library('form_validation');
		$this->load->model('Auth_model');
		$this->load->helper('string');
	}


	public function index()
	{
		// periksa_logout();

		$this->form_validation->set_rules('username', 'Username', 'trim|required|max_length[25]');
		$this->form_validation->set_rules('password', 'Password', 'required|max_length[255]');
			if ($this->form_validation->run() == false) {

				$data['title'] = 'Login';
				$this->load->view('backend/template/auth/auth_header');
				$this->load->view('backend/auth/auth');
				$this->load->view('backend/template/auth/auth_footer');
			} else {
				//validasi berhasil
				$this->_login();
			}
	}

	private function _login()
	{
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);

		$user = $this->db->get_where('mst_user', ['vc_username' => $username])->row_array();
		$akses = NULL;
		if ($user) {
			// Query the role tables directly. The local copy of msv_user_akses can
			// have a hosting-only DEFINER, which makes that view fail on localhost.
			$akses = $this->db->query(
				' SELECT user_role.vc_role_id, role.is_approve, role.is_entry,
				        role.is_update, role.is_view
				  FROM mst_user AS user_account
				  LEFT JOIN tr_role AS user_role ON user_account.nu_id = user_role.vc_user
				  LEFT JOIN mst_role AS role ON user_role.vc_role_id = role.vc_code_role
				  WHERE user_account.nu_id = ?
				  LIMIT 1',
				array($user['nu_id'])
			)->row_array();
		}



		if ($user && $akses && !empty($user['vc_password'])) {
			//user ada di DB
			if ($user['is_active'] == 1) {
				//cek password
				if (password_verify($password, $user['vc_password'])) {
					$this->session->sess_regenerate(TRUE);
					$this->db->delete('tmp_login', array('vc_user_id' => $user['nu_id']));
					$key = random_string('alnum', 80);
					$datas = array(
						'vc_user_id' => $user['nu_id'],
						'vc_token' => $key,
						'dt_login' =>  date("Y-m-d H:i:s"),
						'dt_expired' =>  date("Y-m-d H:i:s", strtotime("+8 hours")),
						'ip_address' => $this->input->ip_address()

					);

					$this->db->insert('tmp_login', $datas);



					$data = [
						'id' => $user['nu_id'],
						'username' => $user['vc_username'],
						'name' => $user['vc_name'],
						'role' => $akses['vc_role_id'],
						'is_approve' => $akses['is_approve'],
						'is_entry' => $akses['is_entry'],
						'is_update' => $akses['is_update'],
						'is_view' => $akses['is_view'],

						'key' => $key
					];
					$this->session->set_userdata($data);

					redirect('dashboard');
				} else {
					$this->_reject_login();
				}
			} else {
				$this->_reject_login();
			}
		} else {
			$this->_reject_login();
		}
	}

	private function _reject_login()
	{
		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Invalid username or password.</div>');
		redirect('auth');
	}

	public function logout()
	{
		if (strtoupper($this->input->method(TRUE)) !== 'POST') {
			show_error('Method Not Allowed', 405);
			return;
		}

		$id = $this->session->userdata('id');
		$this->db->delete('tmp_login', array('vc_user_id' => $id));
		// $this->db->delete('tmp_login', array('vc_user_id' => $id));
		$array_items = array('id', 'username', 'name', 'role', 'key');
		$this->session->unset_userdata($array_items);
		$this->session->sess_destroy();
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You Has Been Log Out !</div>');
		redirect('auth');
	}

	public function maintenace()
	{
		$this->load->view('template/maintenance/maintenance');
	}
}
