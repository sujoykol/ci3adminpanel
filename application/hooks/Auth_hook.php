<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_hook {
    public function check_session() {
        $CI =& get_instance();
		$CI->load->library('session'); // Load the session library
        $user_id = $CI->session->userdata('user_id');

        if (!$user_id && $CI->router->fetch_class() !== 'auth') {
            redirect('auth/login');
        }
    }
}
