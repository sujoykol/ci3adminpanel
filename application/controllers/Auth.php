<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->library('session');
		$this->load->helper(['url', 'form']);
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
				redirect('auth/dashboard');
			} else {
				$data['error'] = "Invalid Username or Password";
			}
		}
		$this->load->view('login', isset($data) ? $data : NULL);
	}

	// Dashboard
	public function dashboard()
	{
		if (!$this->session->userdata('user_id')) {
			redirect('auth/login');
		}
		$data['title'] = "Dashboard";
		$data['view']  = "dashboard"; // inside views/dashboard.php
		$this->load->view('layout', $data);
	}

	// Logout
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login');
	}

	// Change Password
	public function change_password()
	{
		if (!$this->session->userdata('user_id')) {
			redirect('auth/login');
		}

		if ($this->input->post()) {
			$current = $this->input->post('current_password');
			$new = $this->input->post('new_password');
			$confirm = $this->input->post('confirm_password');

			$user = $this->User_model->get_by_id($this->session->userdata('user_id'));

			if ($user && password_verify($current, $user->password)) {
				if ($new === $confirm) {
					$hash = password_hash($new, PASSWORD_DEFAULT);
					$this->User_model->update_password($user->id, $hash);
					$data['success'] = "Password updated successfully!";
				} else {
					$data['error'] = "New passwords do not match!";
				}
			} else {
				$data['error'] = "Current password is incorrect!";
			}
		}

		$data['title'] = "Change Password";
		$data['view']  = "change_password"; // inside views/dashboard.php
		$this->load->view('layout', isset($data) ? $data : NULL);
	}
}
