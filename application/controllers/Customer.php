<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends MY_Controller {

   public function __construct(){
		parent::__construct();
		$this->load->model('Customer_model');
	}
	
	public function index()
	{
		$data['customers'] = $this->Customer_model->get_all();
        $data['title'] = 'Customer List';
        $data['view']  = 'customer/index';

        $this->load->view('layout', $data);
		
	}
	public function create()
	{
		if($this->input->post())
		{
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			 if ($this->form_validation->run()) {
				  $image_name = ''; // Default empty string

            if (!empty($_FILES['image']['name'])) {
                $config['upload_path']   = './uploads/customers/';
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
                    redirect('customer/create');
                }
            }

            $data = [
                'name'   => $this->input->post('name'),
				'email'  => $this->input->post('email'),
				'address'=>$this->input->post('address'),
                'image'  => $image_name, // Now passing a string, not an array
                'status' => $this->input->post('status')
            ];

            $this->Customer_model->insert($data);
            $this->session->set_flashdata('success', 'Customer added successfully.');
            redirect('customer');
			 }
			 else {
            $this->session->set_flashdata('error', 'Validation failed.');
            redirect('customer/create');
        }
			 
		}
		
		
        $data['title'] = 'Add Customer';
        $data['view']  = 'customer/create';

        $this->load->view('layout', $data);
		
	}
	public function delete($id)
	{
		 $customer = $this->Customer_model->get($id);
			  if (file_exists('./uploads/customers/' . $customer->image)) {
                        @unlink('./uploads/customers/' . $customer->image);
                    }
		$this->Customer_model->delete($id);
		 $this->session->set_flashdata('success', 'Customer deleted successfully.');
         redirect('customer');
		
	}
	public function edit($id)
	{
		$customer = $this->Customer_model->get($id);
		$data['customer'] =$customer;
		if($this->input->post())
		{
			 $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run()) {
            // Start with the existing image name as default
            $image_name = $customer->image; 

            // 2. Handle New Image Upload
            if (!empty($_FILES['image']['name'])) {
                $config['upload_path']   = './uploads/customers/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size']      = 2048;
                $config['file_name']     = time();

                $this->upload->initialize($config);

                if ($this->upload->do_upload('image')) {
                    // Delete the OLD image file from the server if a new one is uploaded
                    if (file_exists('./uploads/customers/' . $customer->image)) {
                        @unlink('./uploads/customers/' . $customer->image);
                    }
                    
                    $upload_data = $this->upload->data();
                    $image_name  = $upload_data['file_name']; // Fixed variable name
                } else {
                    // Optional: Handle upload errors
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('customer/edit/' . $id);
                }
            }
                
            $update = [
                'name'   => $this->input->post('name'),
				'email'  => $this->input->post('email'),
				'address'=>$this->input->post('address'),
                'image'  => $image_name, // Now passing a string, not an array
                'status' => $this->input->post('status')
            ];

            $this->Customer_model->update($id, $update);
            $this->session->set_flashdata('success', 'Customer updated successfully.');
            redirect('customer');
        } else {
            // Validation failed - let it fall through to show errors on the form
            $this->session->set_flashdata('error', 'Validation failed. Please check your input.');
        }
		}
		
		
		$data['title'] = 'Edit Customer';
        $data['view']  = 'customer/edit';

        $this->load->view('layout', $data);
	}
	
}
