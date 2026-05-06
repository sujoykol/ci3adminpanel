<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
        // Load the session library
       // $this->load->library('session');

        // Perform the session check
        $user_id = $this->session->userdata('user_id');
        
        // If user_id is not set and the controller is not 'auth', redirect to login
        if (!$user_id && $this->router->fetch_class() !== 'auth') {
            redirect('auth/login');
        }
    }
}
