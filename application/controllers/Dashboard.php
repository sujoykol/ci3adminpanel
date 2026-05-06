<?php
defined('BASEPATH') or exit('No direct script access allowed');

Class Dashboard extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}

	

	public function index()
	{
	
		$data['title'] = "Dashboard";
		$data['view']  = "dashboard"; // inside views/dashboard.php
		$this->load->view('layout', $data);
	}

	public function change_password()
	{
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
					$data['error'] = "New password do not match!";
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
