<?php
use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/Format.php';
require APPPATH . '/config/rest.php';
require APPPATH . '/libraries/REST_Controller.php';
class edificios_controller extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('clEdificios');
    }

    //API -  Regresa todos los edificios con opción de top
    function listaEdificios_post()
    {
        $cod = $this->post('cod');
        $nom = $this->post('nom');
        $orde = $this->post('orde');
        $lat = $this->post('lat');
        $lon = $this->post('lon');
        $acr = $this->post('acr');
        $img = $this->post('img');
        $filtros = array(
            'cod' => $cod,
            'nom' => $nom,
            'orde' => $orde,
            'lat' => $lat,
            'lon' => $lon,
            'acr' => $acr,
            'img' => $img,
        );
        $list = $this->clEdificios->getEdificios($filtros);
        if ($list) {
            $result = array('resp' => $list);
            $this->response(array('resp' => $list), REST_Controller::HTTP_OK);
        } else {
            $this->response(array('resp' => 'No hay registros'),  REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //API - Guarda y actualiza los datos
    function guardarDatos_post()
    {
        $cod = (int)$this->post('cod');
        $nom = $this->post('nom');
        $orde = (int)$this->post('orde');
        $lat = (double)$this->post('lat');
        $lon = (double)$this->post('lon');
        $acr = $this->post('acr');
        $img = $this->post('img');
        $data = array(
            'cod' => $cod,
            'nom' => $nom,
            'orde' => $orde,
            'lat' => $lat,
            'lon' => $lon,
            'acr' => $acr,
            'img' => $img,
        );
        $result = $this->clEdificios->guardarDatos($cod, $data);
        if ($result) {
            $this->response(array("status" => 1), REST_Controller::HTTP_OK);
        } else{
            $this->response(array("status" => 0), REST_Controller::HTTP_NOT_FOUND);
        }            
        // if (empty($result)) {
        //     $this->response("No se puede insertar/recuperar el registro", REST_Controller::HTTP_NOT_FOUND);
        // } else {
        //     $this->response($result, REST_Controller::HTTP_OK);
        // }
    }

    //API - Borra registros
    function borrarDatos_post()
    {
        $id = $this->post('cod');
        if (!$id) {
            $this->response("Parámetro Perdido", REST_Controller::HTTP_NOT_FOUND);
        }
        if ($this->clEdificios->borrarDatos($id)) {
            $this->response("Elminado Correctamente. ", REST_Controller::HTTP_OK);
        } else {
            $this->response("Error al Eliminar", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
