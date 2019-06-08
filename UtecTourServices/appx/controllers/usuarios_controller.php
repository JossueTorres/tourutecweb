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
    function listaUsuarios_post()
    {
        $cod = $this->post('cod');
        $cor = $this->post('cor');
        $con = $this->post('con');
        $conf = $this->post('conf');
        $estu = $this->post('estu');
        $tip = $this->post('tip');
        $filtros = array(
            'cod' => $cod,
            'cor' => $cor,
            'con' => $con,
            'conf' => $conf,
            'estu' => $estu,
            'tip' => $tip,
        );
        $list = $this->clUsuarios->getListaUsuarios($filtros);
        if ($list) {
            $result = array('resp' => $list);
            $this->response(array('resp' => $list), REST_Controller::HTTP_OK);
        } else {
            $this->response(array('resp' => "No hay registros"),  REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //API - Guarda y actualiza los datos
    function guardarDatos_post()
    {
        $cod = $this->post('cod');
        $cor = $this->post('cor');
        $con = $this->post('con');
        $conf = $this->post('conf');
        $estu = $this->post('estu');
        $tip = $this->post('tip');
        $data = array(
            'cod' => $cod,
            'cor' => $cor,
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
        $id = $this->post('cod');
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
