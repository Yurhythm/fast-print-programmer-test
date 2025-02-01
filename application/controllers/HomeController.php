<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeController extends CI_Controller
{

	public function index()
	{
		$header['title'] = 'Home';
		// $this->load->view('_layout/header', $header);
		// $this->load->view('home/index');
		// $this->load->view('_layout/footer');
		$this->load->view('_layout/header_');
	}


	public function get_data_from_api()
	{
		$api_url = "https://recruitment.fastprint.co.id/tes/api_tes_programmer";

		//GET USERNAME PASSWORD API

		$headers = [];

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $api_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$response = curl_exec($ch);

		if ($response === false) {
			echo "cURL Error: " . curl_error($ch);
		} else {
			// Extract headers
			$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
			$header_text = substr($response, 0, $header_size);

			// Convert headers into an array
			$header_lines = explode("\r\n", trim($header_text));
			foreach ($header_lines as $line) {
				if (strpos($line, ': ') !== false) {
					list($key, $value) = explode(': ', $line, 2);
					$headers[$key] = $value;
				}
			}
		}

		curl_close($ch);

		$username = explode(' ', $headers['x-credentials-username'])[0] ?? '';
		$password = md5('bisacoding-' . date('d') . '-' . date('m') . '-' . substr(date('Y'), 2));


		// GET API DATA

		$data = [];

		$body = [
			'username' => $username,
			'password' => $password
		];

		$chh = curl_init();
		curl_setopt($chh, CURLOPT_URL, $api_url);
		curl_setopt($chh, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($chh, CURLOPT_POST, 1);
		curl_setopt($chh, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($chh, CURLOPT_POSTFIELDS, http_build_query($body));
		curl_setopt($chh, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);


		$response = curl_exec($chh);
		curl_close($chh);

		$data = json_decode($response, true)['data']??[];

		// get kategori data
		$kategoris = array_map(function ($item) {
			return $item['kategori'];
		}, $data);
		$kategori_data = array_unique($kategoris);
		$kategori_insert = [];
		foreach ($kategori_data as  $kategoridata) {
			$kategori_insert[] = [
				'nama_kategori' => $kategoridata
			];
		}
		$this->load->model('KategoriModel');
		$this->KategoriModel->insert_unique_kategori($kategori_insert);

		// get status data
		$statuses = array_map(function ($item) {
			return $item['status'];
		}, $data);
		$status_data = array_unique($statuses);
		$status_insert = [];
		foreach ($status_data as  $statusdata) {
			$status_insert[] = [
				'nama_status' => $statusdata
			];
		}
		$this->load->model('StatusModel');
		$this->StatusModel->insert_unique_status($status_insert);

		// insert produk
		$this->load->model('ProdukModel');
		$this->ProdukModel->insert_update_produk($data);

		$return = [
			'meassage' => 'Berhasil mendapatkan data dari API',
		];

		return json_encode($return);
	}
}
