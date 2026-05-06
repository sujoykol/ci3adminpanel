<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MY_Controller {

 public function __construct() {
		parent::__construct();
		$this->load->model('Category_model');
	}

	// LIST
	public function index() {
		$data['categories'] = $this->Category_model->get_all();

		$data['title'] = 'Category List';
		$data['view'] = 'category/index';
		$this->load->view('layout', $data);
	   
	}
	// CREATE
	public function create() {
		
		if ($this->input->post()) {
		   $this->form_validation->set_rules('name', 'Name', 'required');
		if ($this->form_validation->run()) {

			$data = [
				'name' => $this->input->post('name'),
				'status' => $this->input->post('status')
			];
			$this->Category_model->insert($data);
			$this->session->set_flashdata('success', 'Category added successfully.');
			redirect('category');
		}
		else {
			$this->session->set_flashdata('error', 'Something went wrong, please try again.');
			redirect('category/create');
		}
		}
		

		// $data['title'] = 'Add Category'
	   
		$data['title'] = 'Add Category';
		$data['view'] = 'category/create';
		$this->load->view('layout', $data);
	}

	// EDIT
	public function edit($id) {
		$data['category'] = $this->Category_model->get($id);
	   
		if ($this->input->post()) {
			 $this->form_validation->set_rules('name', 'Name', 'required');
		    if ($this->form_validation->run()) {
			$update = [
				'name' => $this->input->post('name'),
				'status' => $this->input->post('status')
			];
			$this->Category_model->update($id, $update);
			$this->session->set_flashdata('success', 'Category updated successfully.');
			redirect('category');
		}
		else {
			$this->session->set_flashdata('error', 'Something went wrong, please try again.');
			redirect('category/edit/' . $id);
		}
		
		
		}

		// DELETE
		public function delete($id) {
			if ($this->Category_model->delete($id)) {
				$this->session->set_flashdata('success', 'Category deleted successfully.');
			} else {
				$this->session->set_flashdata('error', 'Something went wrong, please try again.');
			}
			redirect('category');	
		}
			
}
