<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Secciones_controller extends CI_Controller
{
	public function index()
	{
		$url = 'http://localhost:8080/UtecTourServices/Seccion/listado';
		//creamos
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);

		$result = curl_exec($ch);
		
		//cerramos
		curl_close($ch);
		$data['lstSecciones'] = json_decode($result);
		$this->load->view('_layout/header');
		$this->load->view('Secciones', $data);
		$this->load->view('_Layout/footer');
	}

}