<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProdukModel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database(); // Load database connection
	}

	// cek unique
	public function produk_exists($nama_produk)
	{
		$this->db->where('nama_produk', $nama_produk);
		$query = $this->db->get('produk');
		return $query->num_rows() > 0;
	}

	// Insert update produk
	public function insert_update_produk($data)
	{
		$produk_insert = [];
		foreach ($data as $row) {
			$this->db->where('nama_kategori', $row['kategori']);
			$query = $this->db->get('kategori')->first_row();
			$kategori_id = $query->id_kategori ?? null;

			$this->db->where('nama_status', $row['status']);
			$query = $this->db->get('status')->first_row();
			$status_id = $query->id_status ?? null;

			$rows = [
				'nama_produk' => $row['nama_produk'],
				'harga' => $row['harga'],
				'kategori_id' => $kategori_id,
				'status_id' => $status_id,
			];

			if ($this->produk_exists($row['nama_produk'])) {
				$this->db->where('nama_produk', $row['nama_produk']);
				$this->db->update('produk', $rows);
			} else {
				$produk_insert[] = $rows;
			}
		}

		if (!empty($produk_insert)) {
			$this->db->insert_batch('produk', $produk_insert);
		}
	}


	// Insert new produk
	public function insert_produk($data)
	{
		return $this->db->insert('produk', $data);
	}

	// Get all produk
	public function get_all_produk($data = [])
	{
		$kategori_id = $data['kategori_id'] ?? '';
		$status_id = $data['status_id'] ?? '';

		$this->db->select('produk.id_produk, produk.nama_produk, produk.harga, kategori.nama_kategori, status.nama_status');
		$this->db->from('produk');
		$this->db->join('kategori', 'kategori.id_kategori = produk.kategori_id', 'left');
		$this->db->join('status', 'status.id_status = produk.status_id', 'left');
		if ($kategori_id !== '') {
			$this->db->where('produk.kategori_id', $kategori_id);
		}
		if ($status_id !== '') {
			$this->db->where('produk.status_id', $status_id);
		}
		$query = $this->db->get();

		return $query->result();
	}

	// Get a produk by ID
	public function get_produk_by_id($id)
	{
		return $this->db->get_where('produk', ['id_produk' => $id])->row_array();
	}

	// Get a produk by ID
	public function get_detail_produk($id)
	{
		$this->db->select('produk.id_produk, produk.nama_produk, produk.harga, kategori.nama_kategori, status.nama_status');
		$this->db->from('produk');
		$this->db->join('kategori', 'kategori.id_kategori = produk.kategori_id', 'left');
		$this->db->join('status', 'status.id_status = produk.status_id', 'left');
		$this->db->where('produk.id_produk', $id);
		$query = $this->db->get();
		return $query->first_row();
	}

	// Update a produk
	public function update_produk($id, $data)
	{
		$this->db->where('id_produk', $id);
		return $this->db->update('produk', $data);
	}

	// Delete a produk
	public function delete_produk($id)
	{
		return $this->db->delete('produk', ['id_produk' => $id]);
	}
}
