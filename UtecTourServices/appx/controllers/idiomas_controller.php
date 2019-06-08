<?php
use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/Format.php';
require APPPATH . '/config/rest.php';
require APPPATH . '/libraries/REST_Controller.php';
class idiomas_controller extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('clIdiomas');
    }

    //API -  Regresa todos los registros
    function listaIdiomas_post()
    {
        $cod = $this->post('cod');
        $nom = $this->post('nom');
        $ico = $this->post('ico');
        $aud = $this->post('aud');
        $filtros = array(
            'cod' => $cod,
            'nom' => $nom,
            'ico' => $ico,
            'aud' => $aud
        );
        $list = $this->clIdiomas->getListaIdiomas($filtros);
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
        $nom = $this->post('nom');
        $ico = $this->post('ico');
        $aud = $this->post('aud');
        $data = array(
            'cod' => $cod,
            'nom' => $nom,
            'ico' => $ico,
            'aud' => $aud
        );
        $result = $this->clIdiomas->guardarDatos($cod, $data);
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
        if ($result = $this->clIdiomas->borrarDatos($id)) {
            $this->response("Elminado Correctamente. ", REST_Controller::HTTP_OK);
        } else {
            $this->response("Error al Eliminar", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
