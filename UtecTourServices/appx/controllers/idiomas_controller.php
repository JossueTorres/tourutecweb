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
    function listaIdiomas_get()
    {
        $cod = $this->post('txtCod');
        $nom = $this->post('txtNom');
        $ico = $this->post('txtIco');
        $aud = $this->post('txtAud');             
        $filtros = array(
            'cod' => $cod,
            'nom' => $nom,
            'ico' => $ico,            
            'aud' => $aud 
          );
        $list = $this->clIdiomas->getListaIdiomas($filtros);
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
        $nom = $this->post('txtNom');
        $ico = $this->post('txtIco');
        $aud = $this->post('txtAud');             
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
        $id = $this->post('txtCod');
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
