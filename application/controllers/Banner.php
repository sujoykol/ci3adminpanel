<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends MY_Controller {

 public function __construct() {
		parent::__construct();
		$this->load->model('Banner_model');
	}

	// LIST
	public function index() {
		$data['banners'] = $this->Banner_model->get_all();

		$data['title'] = 'Banner List';
		$data['view'] = 'banner/index';
		$this->load->view('layout', $data);
		
		   
	}
	// CREATE
	public function create() {
    if ($this->input->post()) {
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run()) {
            $image_name = ''; // Default empty string

            if (!empty($_FILES['image']['name'])) {
                $config['upload_path']   = './uploads/banners/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size']      = 2048;
                $config['file_name']     = time();

                $this->upload->initialize($config);

                if ($this->upload->do_upload('image')) {
                    $upload_info = $this->upload->data();
                    $image_name = $upload_info['file_name']; // Extract the string
                } else {
                    // Optional: Handle upload errors here
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('error', $error);
                    redirect('banner/create');
                }
            }

            $data = [
                'name'   => $this->input->post('name'),
                'image'  => $image_name, // Now passing a string, not an array
                'status' => $this->input->post('status')
            ];

            $this->Banner_model->insert($data);
            $this->session->set_flashdata('success', 'Banner added successfully.');
            redirect('banner');
        } else {
            $this->session->set_flashdata('error', 'Validation failed.');
            redirect('banner/create');
        }
    }

    $data['title'] = 'Add Banner';
    $data['view'] = 'banner/create';
    $this->load->view('layout', $data);
}

	// EDIT
	public function edit($id) {
    // 1. Fetch existing data
    $banner = $this->Banner_model->get($id);
    if (!$banner) {
        show_404(); // Handle case where ID doesn't exist
    }
    $data['banner'] = $banner;

    if ($this->input->post()) {
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run()) {
            // Start with the existing image name as default
            $image_name = $banner->image; 

            // 2. Handle New Image Upload
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path']   = './uploads/banners/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size']      = 2048;
                $config['file_name']     = time();

                $this->upload->initialize($config);

                if ($this->upload->do_upload('image')) {
                    // Delete the OLD image file from the server if a new one is uploaded
                    if (file_exists('./uploads/banners/' . $banner->image)) {
                        @unlink('./uploads/banners/' . $banner->image);
                    }
                    
                    $upload_data = $this->upload->data();
                    $image_name  = $upload_data['file_name']; // Fixed variable name
                } else {
                    // Optional: Handle upload errors
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('banner/edit/' . $id);
                }
            }
                
            $update = [
                'name'   => $this->input->post('name'),
                'status' => $this->input->post('status'),
                'image'  => $image_name // Remains the old name if no new file was chosen
            ];

            $this->Banner_model->update($id, $update);
            $this->session->set_flashdata('success', 'Banner updated successfully.');
            redirect('banner');
        } else {
            // Validation failed - let it fall through to show errors on the form
            $this->session->set_flashdata('error', 'Validation failed. Please check your input.');
        }
    }
    
    $data['title'] = 'Edit Banner';
    $data['view']  = 'banner/edit';
    $this->load->view('layout', $data);
}
	

		// DELETE
		public function delete($id) {
			if ($this->Banner_model->delete($id)) {
				$this->session->set_flashdata('success', 'Banner deleted successfully.');
			} else {
				$this->session->set_flashdata('error', 'Something went wrong, please try again.');
			}
			redirect('banner');	
		}
			
}
