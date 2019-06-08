<?php
use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/Format.php';
require APPPATH . '/config/rest.php';
require APPPATH . '/libraries/REST_Controller.php';
class usuarios_controller extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('clUsuarios');
    }

    //API -  Regresa todos los edificios con opción de top
    function listaUsuarios_get()
    {
        $cod = $this->post('txtCod');
        $cor = $this->post('txtCor');
        $con = $this->post('txtCon');
        $conf = $this->post('txtConf');
        $estu = $this->post('txtEstu');
        $tip = $this->post('ddlTip');
        $filtros = array(
            'cod' => $cod,
            'nom' => $cor,
            'con' => $con,
            'conf' => $conf,
            'estu' => $estu,
            'tip' => $tip,
        );
        $list = $this->clUsuarios->getListaUsuarios($filtros);
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
        $cor = $this->post('txtCor');
        $con = $this->post('txtCon');
        $conf = $this->post('txtConf');
        $estu = $this->post('txtEstu');
        $tip = $this->post('ddlTip');
        $data = array(
            'cod' => $cod,
            'nom' => $cor,
            'con' => $con,
            'conf' => $conf,
            'estu' => $estu,
            'tip' => $tip,
        );
        $result = $this->clUsuarios->guardarDatos($cod, $data);
        if ($result)
            $this->response(array('status' => 'Registro se guardo correctamente'), REST_Controller::HTTP_OK);
        else
            $this->response(array('status' => 'fallo'), REST_Controller::HTTP_NOT_FOUND);
    }

    //API - Borra registros
    function borrarDatos_post()
    {
        $id = $this->post('txtCod');
        if (!$id) {
            $this->response("Parámetro Perdido", REST_Controller::HTTP_NOT_FOUND);
        }        
        if ($result = $this->clUsuarios->borrarDatos($id)) {
            $this->response("Elminado Correctamente. ", REST_Controller::HTTP_OK);
        } else {
            $this->response("Error al Eliminar", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
