<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller {

	public function index()
	{


		$header['title'] = 'Product';
        $this->load->view('_layout/header', $header);
		$this->load->view('product/index');
        $this->load->view('_layout/footer');
	}

	public function show($id)
	{
		

		$header['title'] = 'Detail Product';
        $this->load->view('_layout/header', $header);
		$this->load->view('product/show');
        $this->load->view('_layout/footer');
	}

	public function create()
	{
		if ($this->input->server('REQUEST_METHOD') === 'GET') {

			$header['title'] = 'Create Product';
			$this->load->view('_layout/header', $header);
			$this->load->view('product/create');
			$this->load->view('_layout/footer');

		}elseif($this->input->server('REQUEST_METHOD') === 'POST'){

		}
	}

	public function edit($id)
	{


		$header['title'] = 'Edit Product';
		$this->load->view('_layout/header', $header);
		$this->load->view('product/edit');
		$this->load->view('_layout/footer');
	}

	public function update($id)
	{
		if($this->input->server('REQUEST_METHOD') === 'POST'){

		}
	}

	public function delete($id)
	{
		if($this->input->server('REQUEST_METHOD') === 'POST'){

		}
	}
}
