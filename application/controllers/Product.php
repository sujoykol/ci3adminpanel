<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends MY_Controller 
{

	public function __construct(){
		parent::__construct();
		$this->load->model('Product_model');
		$this->load->model('Category_model');
	}

	public function index($offset = 0){
		// Pagination setup
		$config['base_url'] = site_url('product/index');
		$config['total_rows'] = $this->Product_model->get_count();
		$config['per_page'] = 5;
		$this->pagination->initialize($config);
		// Fetch products with pagination
		$data['products'] = $this->Product_model->get_products($config['per_page'], $offset);
		$data['pagination'] = $this->pagination->create_links();
		// Load view
		$data['title'] = 'Product List';
		$data['view'] = 'products/index';
		$this->load->view('layout', $data);
	}

	public function create(){

		 $all_category = $this->Category_model->get_all_category();
		 $data['all_category'] = $all_category;
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
						// -------- THUMBNAIL CREATION ----------
						$thumb_config['image_library']  = 'gd2';
						$thumb_config['source_image']   = './uploads/products/' . $upload_data['file_name'];
						$thumb_config['new_image']      = './uploads/products/thumbs/';
						$thumb_config['create_thumb']   = TRUE;
						$thumb_config['maintain_ratio'] = TRUE;
						$thumb_config['width']          = 200;
						$thumb_config['height']         = 200;
						$this->image_lib->initialize($thumb_config);
						if (!$this->image_lib->resize()) {
							echo $this->image_lib->display_errors();
						}
						$this->image_lib->clear();
                  }
				}
				$product_data = [
					'name' => $this->input->post('name'),
					'description' => $this->input->post('description'),
					'price' => $this->input->post('price'),
					'catid'=> $this->input->post('category'),
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

	public function edit($id){
		$product = $this->Product_model->get_product($id);
		$data['product'] = $product;
		$all_category = $this->Category_model->get_all_category();
		$data['all_category'] = $all_category;
		$image_path = './uploads/products/' . $product->image;
		$thumb_path = './uploads/products/thumbs/' .
        pathinfo($product->image, PATHINFO_FILENAME) .
        '_thumb.' .
        pathinfo($product->image, PATHINFO_EXTENSION);
		if ($this->input->post()) {
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('price', 'Price', 'required|numeric');

			if ($this->form_validation->run()) {
				$upload_data = null;
				if (!empty($_FILES['image']['name'])) {
					 if (!empty($product->image) && file_exists($image_path)) {
                          unlink($image_path);
                   }
				 if (!empty($product->image) && file_exists($thumb_path)) {
						unlink($thumb_path);
					}   
					$config['upload_path'] = './uploads/products/';
					$config['allowed_types'] = 'jpg|jpeg|png';
					$config['max_size'] = 2048;
					$config['file_name'] = time();
					$this->upload->initialize($config);
					if ($this->upload->do_upload('image')) {
						$upload_data = $this->upload->data();
						// -------- THUMBNAIL CREATION ----------
						$thumb_config['image_library']  = 'gd2';
						$thumb_config['source_image']   = './uploads/products/' . $upload_data['file_name'];
						$thumb_config['new_image']      = './uploads/products/thumbs/';
						$thumb_config['create_thumb']   = TRUE;
						$thumb_config['maintain_ratio'] = TRUE;
						$thumb_config['width']          = 200;
						$thumb_config['height']         = 200;
						$this->image_lib->initialize($thumb_config);
						if (!$this->image_lib->resize()) {
							echo $this->image_lib->display_errors();
						}
						$this->image_lib->clear();
                  }
				}

				$product_data = [
					'name' => $this->input->post('name'),
					'catid' => $this->input->post('category'),
					'description' => $this->input->post('description'),
					'price' => $this->input->post('price'),
				];
				if ($upload_data) {
					$product_data['image'] = $upload_data['file_name'];
				}
				$this->Product_model->update_product($id, $product_data);
				redirect('product');
				$this->session->set_flashdata('success', 'Product updated successfully');
			}
		}
		$data['title'] = 'Edit Product';
		$data['view'] = 'products/edit';
		$this->load->view('layout', $data);
	}

	public function delete($id){
	$product = $this->Product_model->get_product($id);
    if (!$product) {
        $this->session->set_flashdata('error', 'Product not found');
        redirect('product');
    }

	       // ---------- FILE PATHS ----------
    $image_path = './uploads/products/' . $product->image;
    $thumb_path = './uploads/products/thumbs/' .
        pathinfo($product->image, PATHINFO_FILENAME) .
        '_thumb.' .
        pathinfo($product->image, PATHINFO_EXTENSION);

    // ---------- DELETE ORIGINAL IMAGE ----------
    if (!empty($product->image) && file_exists($image_path)) {
        unlink($image_path);
    }
    // ---------- DELETE THUMBNAIL ----------
    if (!empty($product->image) && file_exists($thumb_path)) {
        unlink($thumb_path);
    }
		$this->Product_model->delete_product($id);
		 $this->session->set_flashdata('success', 'Product deleted successfully');
		redirect('product');
	}
}
