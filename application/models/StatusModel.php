<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StatusModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load database connection
    }

    // Insert new status
    public function insert_status($data) {
        return $this->db->insert('status', $data);
    }

    // Get all status
    public function get_all_status() {
        return $this->db->get('status')->result_array();
    }

    // Get a status by ID
    public function get_status_by_id($id) {
        return $this->db->get_where('status', ['id_status' => $id])->row_array();
    }

    // Update a status
    public function update_status($id, $data) {
        $this->db->where('id_status', $id);
        return $this->db->update('status', $data);
    }

    // Delete a status
    public function delete_status($id) {
        return $this->db->delete('status', ['id_status' => $id]);
    }
}
