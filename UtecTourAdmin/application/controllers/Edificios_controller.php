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
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}
	public function index()
	{
		$url = 'http://localhost:8080/UtecTourServices/Edificios/listado';
		//creamos
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);

		$result = curl_exec($ch);

		//cerramos
		curl_close($ch);

		$res = json_decode($result);
		$data['lstEdificios'] = json_decode($result);
		$this->load->view('_Layout/Header_Master');
		$this->load->view('Edificios', $data);
		$this->load->view('_Layout/Footer_Master');
	}

	public function Buscar()
	{
		$a = $this->input->post("txtAcronimo");
		$n = $this->input->post("txtNombre");
		$url = base_url('/Tour-Api/Edificios/listaEdificios_fil/?n=' . $n . '&a=' . $a);
		//creamos
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);

		$result = curl_exec($ch);

		//cerramos
		curl_close($ch);

		$data['lstEdificios'] = json_decode($result);
		$this->load->view('_Layout/Header_Master');
		$this->load->view('Edificios', $data);
		$this->load->view('_Layout/Footer_Master');
	}

	public function guardarDatos()
	{
		$id = $this->input->post("codedf");
		$_param = array(
			'txtCod' => $id,
			'txtNom' => $this->input->post("txtNombre"),
			'txtOrd' => $this->input->post("txtOrden"),
			'txtLat' => $this->input->post("txtLatitud"),
			'txtLon' => $this->input->post("txtLongitud"),
			'txtAcr' => $this->input->post("txtAcronimo"),
			'txtImg' => $this->input->post("txtImg"),
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
		(int)$result = json_decode(curl_exec($ch));
		// (int)$res = json_decode($result);

		//cerramos el Curl
		curl_close($ch);

		// $id = $this->input->POST('codedf');
		if ($id > 0) {
			$do = "Modificado";
			$er = "modificar";
		} else {
			$do = "Agregado";
			$er = "agregar";
		}
		if ($result>0) {
			$this->session->set_flashdata('success_msg', $do . ' correctamente');
		} else {
			$this->session->set_flashdata('error_msg', 'Error al ' . $er);
		}
		header('location:' . base_url('/Edificios'));
	}

	public function borrarDatos($ids)
	{
		$ids = $this->input->post('chkBorrar');
		$url = URLWS.'/Edificios/borrarDatos';		

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
		$result = curl_exec($ch);

		//cerramos el Curl
		curl_close($ch);
		
		if (!empty($ids)) {
			$result = $this->clEdificio->borrarDatos($ids);
			if ($result) {
				$this->session->set_flashdata('success_msg', 'Los registros seleccionados se eliminaron correctamente');
			} else {
				$this->session->set_flashdata('error_msg', 'Fallo al eliminar registros');
			}
		} else {
			$this->session->set_flashdata('error_msg', 'Seleccione al menos 1 registro para eliminar');
		}
		header('location:' . base_url('/TourUtec_Admin/Edificios'));
	}
}
