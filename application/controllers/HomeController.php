<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

	public function index()
	{


		$header['title'] = 'Home';
        $this->load->view('_layout/header', $header);
		$this->load->view('home/index');
        $this->load->view('_layout/footer');
	}
}
