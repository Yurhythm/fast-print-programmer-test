<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdukModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load database connection
    }

    // Insert new produk
    public function insert_produk($data) {
        return $this->db->insert('produk', $data);
    }

    // Get all produk
    public function get_all_produk() {
        return $this->db->get('produk')->result_array();
    }

    // Get a produk by ID
    public function get_produk_by_id($id) {
        return $this->db->get_where('produk', ['id_produk' => $id])->row_array();
    }

    // Update a produk
    public function update_produk($id, $data) {
        $this->db->where('id_produk', $id);
        return $this->db->update('produk', $data);
    }

    // Delete a produk
    public function delete_produk($id) {
        return $this->db->delete('produk', ['id_produk' => $id]);
    }
}
