<?php
use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/Format.php';
require APPPATH . '/config/rest.php';
require APPPATH . '/libraries/REST_Controller.php';
class texto_controller extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('clTexto');
    }

    //API -  Regresa todos los registros
    function listaTextos_get()
    {
        $sec = $this->post('ddlSec');
        $idm = $this->post('ddlIdm');
        $tit = $this->post('txtTit');
        $con = $this->post('txtCon');
        $filtros = array(
            'cod' => $sec,
            'nom' => $idm,
            'ico' => $tit,
            'aud' => $con
        );
        $list = $this->clTexto->getListaTextos($filtros);
        if ($list) {
            $result = array('resp' => $list);
            $this->response($list, REST_Controller::HTTP_OK);
        } else {
            $this->response("No hay registros",  REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //API - Guarda y actualiza los datos
    function guardarDatos_post()
    {
        $sec = $this->post('ddlSec');
        $idm = $this->post('ddlIdm');
        $tit = $this->post('txtTit');
        $con = $this->post('txtCon');
        $cod = array('sec' => $sec, 'idm' => $idm);
        $data = array(
            'cod' => $sec,
            'nom' => $idm,
            'ico' => $tit,
            'aud' => $con
        );
        $result = $this->clTexto->guardarDatos($cod, $data);
        if ($result)
            $this->response(array('status' => 'Registro se guardo correctamente'), REST_Controller::HTTP_OK);
        else
            $this->response(array('status' => 'fallo'), REST_Controller::HTTP_NOT_FOUND);
    }

    //API - Borra registros
    function borrarDatos_post()
    {
        $sec = $this->post('ddlSec');
        $idm = $this->post('ddlIdm');
        $id = array(
            'sec' => $sec,
            'idm' => $idm,
            'tit' => 0,
            'con' => ''
        );
        if (empty($id)) {
            $this->response("Parámetro Perdido", REST_Controller::HTTP_NOT_FOUND);
        }
        if ($result = $this->clTexto->borrarDatos($id)) {
            $this->response("Elminado Correctamente. ", REST_Controller::HTTP_OK);
        } else {
            $this->response("Error al Eliminar", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
