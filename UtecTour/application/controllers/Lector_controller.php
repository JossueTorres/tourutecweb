<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lector_controller extends CI_Controller
{
	public function index()
	{
		$this->load->view('_layout/header');
		$this->load->view('LectorQR');
		$this->load->view('_Layout/footer');
	}

}
