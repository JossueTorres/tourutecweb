<?php
use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/Format.php';
require APPPATH . '/config/rest.php';
require APPPATH . '/libraries/REST_Controller.php';
class seccion_controller extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('clSeccion');
    }

    //API -  Regresa todos los registros
    function listaSecciones_get()
    {
        $cod = $this->post('txtCod');
        $edf = $this->post('ddlEdf');
        $orde = $this->post('txtOrd');
        $nom = $this->post('txtNom');        
        $lat = $this->post('txtLat');
        $lon = $this->post('txtLon');        
        $filtros = array(
            'cod' => $cod,
            'edf' => $edf,
            'orde' => $orde,
            'nom' => $nom,            
            'lat' => $lat,
            'lon' => $lon,
        );
        $list = $this->clSeccion->getListaSeccion($filtros);
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
        $edf = $this->post('ddlEdf');
        $orde = $this->post('txtOrd');
        $nom = $this->post('txtNom');        
        $lat = $this->post('txtLat');
        $lon = $this->post('txtLon');        
        $data = array(
            'cod' => $cod,
            'edf' => $edf,
            'orde' => $orde,
            'nom' => $nom,            
            'lat' => $lat,
            'lon' => $lon
        );
        $result = $this->clSeccion->guardarDatos($cod, $data);
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
        if ($result = $this->clSeccion->borrarDatos($id)) {
            $this->response("Elminado Correctamente. ", REST_Controller::HTTP_OK);
        } else {
            $this->response("Error al Eliminar", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
