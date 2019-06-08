<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Edificios_controller extends CI_Controller
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
            'orde' => 0,
            'lat' => 0,
            'lon' => 0,
            'acr' => $this->input->post("txtAcrFil"),
            'img' => '',
		);
		$postData = '';
		foreach ($_param as $k => $v) {
			$postData .= $k . '=' . $v . '&';
		}
		rtrim($postData, '&');
		$url = URLWS . '/Edificios/listado';
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
		$this->load->view('Edificios', $data);
		$this->load->view('_Layout/Footer_Master');
	}

	public function guardarDatos()
	{
		// $id = (int)$this->input->post("codedf");
		$_param = array(
            'cod' => $this->input->post("codedf"),
            'nom' => $this->input->post("txtNombre"),
            'orde' => $this->input->post("txtOrden"),
            'lat' => $this->input->post("txtLatitud"),
            'lon' => $this->input->post("txtLongitud"),
            'acr' => $this->input->post("txtAcronimo"),
            'img' => $this->input->post("txtImg"),
		);
		$postData = '';
		//Creamos arreglo nombre/valor separado por &
		foreach ($_param as $k => $v) {
			$postData .= $k . '=' . $v . '&';
		}
		rtrim($postData, '&');

		$url = URLWS.'/Edificios/guardarDatos/';		

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
		// (int)$res = json_decode($result);

		//cerramos el Curl
		curl_close($ch);

		// $id = $this->input->POST('codedf');
		// if ($id > 0) {
		// 	$do = "Modificado";
		// 	$er = "modificar";
		// } else {
		// 	$do = "Agregado";
		// 	$er = "agregar";
		// }
		// if ($result>0) {
		// 	$this->session->set_flashdata('success_msg', $do . ' correctamente');
		// } else {
		// 	$this->session->set_flashdata('error_msg', 'Error al ' . $er);
		// }
		header('location:' . base_url('/Edificios'));
	}

	public function borrarDatos()
	{
		$ids = $this->input->post("chkBorrar");
		//_________________________________________________________________
		//Recojo y arreglo los parametros
		$url = URLWS . '/Edificios/borrarDatos';
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
		header('location:' . base_url('/Edificios'));
	}
}
