<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		//$this->load->model('User_model');
		/*$this->load->library('session');
		$this->load->helper(['url', 'form']);*/
	}

	// Login Page
	public function login()
	{
		if ($this->input->post()) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$user = $this->User_model->get_user($username);

			if ($user && password_verify($password, $user->password)) {
				$this->session->set_userdata('user_id', $user->id);
				redirect('dashboard');
			} else {
				$data['error'] = "Invalid Username or Password";
			}
		}
		$this->load->view('login', isset($data) ? $data : NULL);
	}

	// Dashboard
	

	// Logout
	public function logout()
	{
		$this->session->sess_destroy();
		return redirect()->to('/auth/login');
	}

	
	
}
