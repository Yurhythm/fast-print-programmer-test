<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductController extends CI_Controller
{

	public function index()
	{
		$this->load->model('KategoriModel');
		$data['kategoris'] = $this->KategoriModel->get_all_kategori();

		$this->load->model('StatusModel');
		$data['statuses'] = $this->StatusModel->get_all_status();

		$header['title'] = 'Product';
		$this->load->view('_layout/header', $header);
		$this->load->view('product/index', $data);
		$this->load->view('_layout/footer');
	}

	public function get_data()
	{
		try {
			if ($this->input->is_ajax_request()) {
				$data = [
					'kategori_id' => $this->input->post('kategori_id'),
					'status_id' => $this->input->post('status_id'),
				];

				$this->load->model('ProdukModel');
				$datas = $this->ProdukModel->get_all_produk($data);

				$return = [
					'status' => true,
					'message' => 'Berhasil mendapatkan data',
					'data' => $datas,
				];

				$this->output
					->set_content_type('application/json')
					->set_status_header(200)
					->set_output(json_encode($return));
			}
		} catch (\Exception $e) {
			$return = [
				'status' => true,
				'message' => $e,
				'data' => [],
			];

			$this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode($return));
		}
	}

	public function show($id)
	{
		$this->load->model('ProdukModel');
		$data['datas'] = $this->ProdukModel->get_detail_produk($id);

		$header['title'] = 'Detail Product';
		$this->load->view('_layout/header', $header);
		$this->load->view('product/show', $data);
		$this->load->view('_layout/footer');
	}

	public function create()
	{
		if ($this->input->server('REQUEST_METHOD') === 'GET') {
			$this->load->model('KategoriModel');
			$data['kategoris'] = $this->KategoriModel->get_all_kategori();

			$this->load->model('StatusModel');
			$data['statuses'] = $this->StatusModel->get_all_status();

			$header['title'] = 'Create Product';
			$this->load->view('_layout/header', $header);
			$this->load->view('product/create', $data);
			$this->load->view('_layout/footer');
		} elseif ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required', [
				'required' => 'Nama produk wajib diisi.'
			]);

			$this->form_validation->set_rules('harga', 'Harga', 'required|numeric', [
				'required' => 'Harga produk wajib diisi.',
				'numeric' => 'Harga harus berupa angka.'
			]);

			if ($this->form_validation->run() == FALSE) {
				$return = [
					'status' => false,
					'errors' => [
						'nama_produk' => form_error('nama_produk'),
						'harga' => form_error('harga')
					]
				];
				$this->session->set_flashdata($return);
				redirect('product/create');
			} else {
				try {
					$data = [
						'nama_produk' => $this->input->post('nama_produk'),
						'harga' => $this->input->post('harga'),
						'kategori_id' => $this->input->post('kategori_id'),
						'status_id' => $this->input->post('status_id'),
					];

					$this->load->model('ProdukModel');
					$this->ProdukModel->insert_produk($data);


					$return = [
						'status' => true,
						'message' => 'Produk berhasil ditambahkan',
					];
					$this->session->set_flashdata($return);
					redirect('product');
				} catch (\Exception $e) {
					$return = [
						'status' => false,
						'message' => $e,
					];
					$this->session->set_flashdata($return);
					redirect('product');
				}
			}
		}
	}

	public function edit($id)
	{
		$this->load->model('ProdukModel');
		$data['data'] = $this->ProdukModel->get_produk_by_id($id);

		$this->load->model('KategoriModel');
		$data['kategoris'] = $this->KategoriModel->get_all_kategori();

		$this->load->model('StatusModel');
		$data['statuses'] = $this->StatusModel->get_all_status();

		$header['title'] = 'Edit Product';
		$this->load->view('_layout/header', $header);
		$this->load->view('product/edit', $data);
		$this->load->view('_layout/footer');
	}

	public function update($id)
	{
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'required', [
				'required' => 'Nama produk wajib diisi.'
			]);

			$this->form_validation->set_rules('harga', 'Harga', 'required|numeric', [
				'required' => 'Harga produk wajib diisi.',
				'numeric' => 'Harga harus berupa angka.'
			]);

			if ($this->form_validation->run() == FALSE) {
				$return = [
					'status' => false,
					'errors' => [
						'nama_produk' => form_error('nama_produk'),
						'harga' => form_error('harga')
					]
				];
				$this->session->set_flashdata($return);
				redirect('product/' . $id . '/edit');
			} else {
				try {
					$data = [
						'nama_produk' => $this->input->post('nama_produk'),
						'harga' => $this->input->post('harga'),
						'kategori_id' => $this->input->post('kategori_id'),
						'status_id' => $this->input->post('status_id'),
					];

					$this->load->model('ProdukModel');
					$this->ProdukModel->update_produk($id, $data);


					$return = [
						'status' => true,
						'message' => 'Produk berhasil diubah',
					];
					$this->session->set_flashdata($return);
					redirect('product');
				} catch (\Exception $e) {
					$return = [
						'status' => false,
						'message' => $e,
					];
					$this->session->set_flashdata($return);
					redirect('product');
				}
			}
		}
	}

	public function delete($id)
	{
		if ($this->input->is_ajax_request()) {
			$this->load->model('ProdukModel');
			$this->ProdukModel->delete_produk($id);

			$return = [
				'status' => true,
				'message' => 'Berhasil menghapus data',
			];
			$this->output
				->set_content_type('application/json')
				->set_status_header(200)
				->set_output(json_encode($return));
		}
	}
}
