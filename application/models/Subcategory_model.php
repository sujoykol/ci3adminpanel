<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategory_model extends CI_Model
{

    private $table = 'subcategories';
	
    public function get_all()
    {
        $this->db->select('subcategories.*, categories.name as category_name');
        $this->db->from('subcategories');
        $this->db->join('categories', 'categories.id = subcategories.category_id');
		$this->db->order_by('subcategories.id', 'DESC');
        return $this->db->get()->result();
    }

    public function insert($data)
    {
        return $this->db->insert('subcategories', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('subcategories', ['id' => $id]);
    }

	public function get($id) {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

	 public function update($id, $data) {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function change_status($id, $status)
    {
        return $this->db->update(
            'subcategories',
            ['status' => $status],
            ['id' => $id]
        );
    }
	public function get_sub_category($id)
	{
		return $this->db->where('category_id', $id)->get($this->table)->row();
	}
}
