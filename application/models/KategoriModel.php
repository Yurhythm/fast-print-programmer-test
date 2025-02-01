<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load database connection
    }

    // Insert new kategori
    public function insert_kategori($data) {
        return $this->db->insert('kategori', $data);
    }

    // Get all kategori
    public function get_all_kategori() {
        return $this->db->get('kategori')->result_array();
    }

    // Get a kategori by ID
    public function get_kategori_by_id($id) {
        return $this->db->get_where('kategori', ['id_kategori' => $id])->row_array();
    }

    // Update a kategori
    public function update_kategori($id, $data) {
        $this->db->where('id_kategori', $id);
        return $this->db->update('kategori', $data);
    }

    // Delete a kategori
    public function delete_kategori($id) {
        return $this->db->delete('kategori', ['id_kategori' => $id]);
    }
}
