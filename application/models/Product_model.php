<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function get_products($limit, $offset) {
       $this->db->select('products.*, products.name AS product_name,
            categories.name AS category_name');
        $this->db->from('products');
        $this->db->join('categories', 'categories.id = products.catid', 'left');
        $this->db->limit($limit, $offset);
        $this->db->order_by('products.id', 'DESC');   // 👈 limit added
        return $this->db->get()->result();
    }

    public function get_count() {
        return $this->db->count_all('products');
    }

    public function insert_product($data) {
        return $this->db->insert('products', $data);
    }

    public function get_product($id) {
        return $this->db->get_where('products', ['id' => $id])->row();
    }

    public function update_product($id, $data) {
        return $this->db->where('id', $id)->update('products', $data);
    }

    public function delete_product($id) {
        return $this->db->delete('products', ['id' => $id]);
    }
}
