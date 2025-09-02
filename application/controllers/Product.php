<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			redirect('auth/login');
		}
		$this->load->model('Product_model');
		$this->load->library(['form_validation', 'pagination', 'upload']);
	}

	public function index($offset = 0)
	{
		// Pagination setup
		$config['base_url'] = site_url('product/index');
		$config['total_rows'] = $this->Product_model->get_count();
		$config['per_page'] = 5;

		$this->pagination->initialize($config);

		$data['products'] = $this->Product_model->get_products($config['per_page'], $offset);
		$data['pagination'] = $this->pagination->create_links();

		$data['title'] = 'Product List';
		$data['view'] = 'products/index';
		$this->load->view('layout', $data);
	}

	public function create()
	{
		if ($this->input->post()) {
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required|numeric');

			if ($this->form_validation->run()) {
				$upload_data = null;
				if (!empty($_FILES['image']['name'])) {
					$config['upload_path'] = './uploads/products/';
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = 2048;
					$config['file_name'] = time();

					$this->upload->initialize($config);
					if ($this->upload->do_upload('image')) {
						$upload_data = $this->upload->data();
					}
				}

				$product_data = [
					'name' => $this->input->post('name'),
					'description' => $this->input->post('description'),
					'price' => $this->input->post('price'),
					'image' => $upload_data ? $upload_data['file_name'] : null
				];

				$this->Product_model->insert_product($product_data);
				$this->session->set_flashdata('success', 'Product added successfully.');
				redirect('product');
			} else {
				$this->session->set_flashdata('error', 'Something went wrong, please try again.');
				redirect('product/create');
			}
		}

		$data['title'] = 'Add Product';
		$data['view'] = 'products/create';
		$this->load->view('layout', $data);
	}

	public function edit($id)
	{
		$data['product'] = $this->Product_model->get_product($id);

		if ($this->input->post()) {
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required|numeric');

			if ($this->form_validation->run()) {
				$upload_data = null;
				if (!empty($_FILES['image']['name'])) {
					$config['upload_path'] = './uploads/products/';
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = 2048;
					$config['file_name'] = time();

					$this->upload->initialize($config);
					if ($this->upload->do_upload('image')) {
						$upload_data = $this->upload->data();
					}
				}

				$product_data = [
					'name' => $this->input->post('name'),
					'description' => $this->input->post('description'),
					'price' => $this->input->post('price'),
				];

				if ($upload_data) {
					$product_data['image'] = $upload_data['file_name'];
				}

				$this->Product_model->update_product($id, $product_data);
				redirect('product');
			}
		}

		$data['title'] = 'Edit Product';
		$data['view'] = 'products/edit';
		$this->load->view('layout', $data);
	}

	public function delete($id)
	{
		$this->Product_model->delete_product($id);
		redirect('product');
	}
}
