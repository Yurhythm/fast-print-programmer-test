<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load database connection
    }

	// cek unique
    public function kategori_exists($nama_kategori) {
        $this->db->where('nama_kategori', $nama_kategori);
        $query = $this->db->get('kategori');
        return $query->num_rows() > 0;
    }

    // Insert unique kategori
    public function insert_unique_kategori($data) {
		$unique_data = [];

        foreach ($data as $row) {
            if (!$this->kategori_exists($row['nama_kategori'])) {
                $unique_data[] = $row;
            }
        }

        if (!empty($unique_data)) {
            $this->db->insert_batch('kategori', $unique_data);
        }
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
