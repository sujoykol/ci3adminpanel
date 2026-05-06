<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Subcategory extends MY_Controller
{
	public function __construct(){
		parent::__construct();
		
		$this->load->model('Category_model');
		$this->load->model('Subcategory_model');
	}
	
    public function index()
    {
        $data['subcategories'] = $this->Subcategory_model->get_all();

        $data['title'] = 'Sub Category List';
        $data['view']  = 'subcategory/index';

        $this->load->view('layout', $data);
    }

    public function create()
    {
        if ($this->input->post()) {
            $insert = [
                'category_id' => $this->input->post('category_id'),
                'name'        => $this->input->post('name'),
                'status'      => $this->input->post('status')
            ];

            $this->Subcategory_model->insert($insert);
			$this->session->set_flashdata('success', 'Sub Category added successfully.');
            redirect('subcategory');
        }

        $data['categories'] = $this->Category_model->get_all_category();
        $data['title'] = 'Add Sub Category';
        $data['view']  = 'subcategory/create';

        $this->load->view('layout', $data);
    }

    public function status($id, $status)
    {
        $this->Subcategory_model->change_status($id, $status);
        redirect('subcategory');
    }
	public function edit($id)
	{
		if ($this->input->post()) {
			$update = [
				'category_id' => $this->input->post('category_id'),
				'name'        => $this->input->post('name'),
				'status'      => $this->input->post('status')
			];

			$this->Subcategory_model->update($id, $update);
			$this->session->set_flashdata('success', 'Sub Category updated successfully.');
			redirect('subcategory');
		}

		$data['subcategory'] = $this->Subcategory_model->get($id);
		$data['categories'] = $this->Category_model->get_all();
		$data['title'] = 'Edit Sub Category';
		$data['view']  = 'subcategory/edit';

		$this->load->view('layout', $data);
	}

    public function delete($id)
    {
        $this->Subcategory_model->delete($id);
		$this->session->set_flashdata('success', 'Sub Category deleted successfully.');
        redirect('subcategory');
    }
}
