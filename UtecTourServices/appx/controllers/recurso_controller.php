<?php
use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/Format.php';
require APPPATH . '/config/rest.php';
require APPPATH . '/libraries/REST_Controller.php';
class recurso_controller extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('clRecursos');
    }

    //API -  Regresa todos los registros
    function listaRecursos_get()
    {
        $cod = $this->post('txtCod');
        $sec = $this->post('ddlSec');
        $idm = $this->post('ddlIdm');
        $url = $this->post('txtUrl');
        $tip = $this->post('ddlTip');
        $filtros = array(
            'cod' => $cod,
            'sec' => $sec,
            'idm' => $idm,
            'url' => $url,
            'tip' => $tip
        );
        $list = $this->clRecursos->getListaRecursos($filtros);
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
        $cod = $this->post('txtCod');
        $sec = $this->post('ddlSec');
        $idm = $this->post('ddlIdm');
        $url = $this->post('txtUrl');
        $tip = $this->post('ddlTip');
        $data = array(
            'cod' => $cod,
            'sec' => $sec,
            'idm' => $idm,
            'url' => $url,
            'tip' => $tip
        );
        $result = $this->clRecursos->guardarDatos($cod, $data);
        if ($result)
            $this->response(array('status' => 'Registro se guardo correctamente'), REST_Controller::HTTP_OK);
        else
            $this->response(array('status' => 'fallo'), REST_Controller::HTTP_NOT_FOUND);
    }

    //API - Borra registros
    function borrarDatos_post()
    {
        $id = $this->post('txtCod');        
        if (empty($id)) {
            $this->response("Parámetro Perdido", REST_Controller::HTTP_NOT_FOUND);
        }
        if ($result = $this->clRecursos->borrarDatos($id)) {
            $this->response("Elminado Correctamente. ", REST_Controller::HTTP_OK);
        } else {
            $this->response("Error al Eliminar", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
