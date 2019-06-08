<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Idiomas_controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		//verificar la session de usuario
		$ardat = $this->session->userdata();
		if (!$ardat['login']) {
			redirect(base_url('/Login'));
		}
	}
	public function index()
	{		
		$_param = array(
            'cod' => 0,
            'nom' => $this->input->post("txtNomFil"),
            'ico' => '',            
            'aud' => '',
		);
		$postData = '';
		foreach ($_param as $k => $v) {
			$postData .= $k . '=' . $v . '&';
		}
		rtrim($postData, '&');
		$url = URLWS . '/Idiomas/listado';
		//creamos
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, USERAGENTWS);
		curl_setopt($ch, CURLOPT_COOKIE, COOKIECURL);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 20);
		curl_setopt($ch, CURLOPT_POST, count($_param));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

		$data = json_decode(curl_exec($ch));

		//cerramos
		curl_close($ch);
		// var_dump($result);
		// $res = json_decode($result);
		// $data['lstEdificios'] = json_decode($result);
		$this->load->view('_Layout/Header_Master');
		$this->load->view('Idiomas', $data);
		$this->load->view('_Layout/Footer_Master');
	}
	public function guardarDatos()
	{
		// $id = (int)$this->input->post("codedf");
		$_param = array(
            'cod' => $this->input->post("codidm"),
            'nom' => $this->input->post("txtNom"),
            'ico' => $this->input->post("txtIco"),            
            'aud' => $this->input->post("txtAud"),
		);
		$postData = '';
		//Creamos arreglo nombre/valor separado por &
		foreach ($_param as $k => $v) {
			$postData .= $k . '=' . $v . '&';
		}
		rtrim($postData, '&');

		$url = URLWS.'/Idiomas/guardarDatos/';		

		//creamos nuevo recurso cURL y su Conf
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, USERAGENTWS);
		curl_setopt($ch, CURLOPT_COOKIE, COOKIECURL);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 20);
		curl_setopt($ch, CURLOPT_POST, count($_param));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

		//Obtenemos el resultado
		$result = json_decode(curl_exec($ch));
		
		curl_close($ch);

		header('location:' . base_url('/Idiomas'));
	}

	public function borrarDatos()
	{
		$ids = $this->input->post("chkBorrar");
		//_________________________________________________________________
		//Recojo y arreglo los parametros
		$url = URLWS . '/Idiomas/borrarDatos';
		//_________________________________________________________________
		//_________________________________________________________________
		//creamos nuevo recurso cURL y su Conf (Esto mejor que ni se toque siempre va)
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, USERAGENTWS);
		curl_setopt($ch, CURLOPT_COOKIE, COOKIECURL);
		curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 20);
		curl_setopt($ch, CURLOPT_POST, 4);
		//_________________________________________________________________

		foreach ($ids as $id) {
			$postData =  'cod=' . $id;
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			curl_exec($ch);
		}
		//_________________________________________________________________				
		//Obtenemos el resultado
		//_________________________________________________________________
		// $data = json_decode(curl_exec($ch));
		//cerramos el Curl
		curl_close($ch);
		//_________________________________________________________________
		header('location:' . base_url('/Idiomas'));
	}
}
