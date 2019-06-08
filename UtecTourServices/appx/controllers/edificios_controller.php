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
    function listaEdificios_get()
    {
        $cod = $this->post('txtCod');
        $nom = $this->post('txtNom');
        $orde = $this->post('txtOrd');
        $lat = $this->post('txtLat');
        $lon = $this->post('txtLon');
        $acr = $this->post('txtAcr');
        $img = $this->post('txtImg');
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
            $this->response($list, REST_Controller::HTTP_OK);
        } else {
            $this->response("No hay registros",  REST_Controller::HTTP_NOT_FOUND);
        }
    }

    //API - Guarda y actualiza los datos
    function guardarDatos_post()
    {
        $cod = (int)$this->post('txtCod');
        $nom = $this->post('txtNom');
        $orde = (int)$this->post('txtOrd');
        $lat = (double)$this->post('txtLat');
        $lon = (double)$this->post('txtLon');
        $acr = $this->post('txtAcr');
        $img = $this->post('txtImg');
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
        $id = $this->post('txtCod');
        if (!$id) {
            $this->response("Parámetro Perdido", REST_Controller::HTTP_NOT_FOUND);
        }
        if ($result = $this->clEdificios->borrarDatos($id)) {
            $this->response("Elminado Correctamente. ", REST_Controller::HTTP_OK);
        } else {
            $this->response("Error al Eliminar", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
