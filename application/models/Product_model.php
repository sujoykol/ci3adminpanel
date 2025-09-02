<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_model extends CI_Model {

    public function get_products($limit, $offset) {
        return $this->db->limit($limit, $offset)
                        ->order_by('id', 'DESC')
                        ->get('products')
                        ->result();
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
