<?php
defined('BASEPATH') or exit('No direct script access allowed');
use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';

class tipoAccion_controller extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
        $this->load->model("clTipoAccion");
    }

    public function listaTiposAcciones_get()
    {
        //ponemos lo que venga de los filtros;
        $cod = $this->post('txtCod');
        $nom = $this->post('txtNom');
        $data = array(
            'cod' => $cod,
            'nom' => $nom,          
        );
        $list = $this->clTipoAccion->getListaTipoAcciones($data);
        if(!is_null($list)){
            $this->response($list,200);
        }else {
            $this->response(array('resp'=>'No hay registros'),404);
        }
    }

    public function guardarDatos_post()
    {
        $cod = $this->post('txtCod');
        $nom = $this->post('txtNom');
        $data = array(
            'cod' => $cod,
            'nom' => $nom,        
        );
        if ($this->clTipoAccion->guardarDatos($cod, $data))
            $this->response(array('status' => 'Registro se guardo correctamente'));
        else
            $this->response(array('status' => 'fallo'));
    }

    // este verbo si hace un delete como tal en la bd, en nuestros cruds no se va a eliminar info pero dejo el metodo de ejemplo
    // implementado  por si algun requerimeinto lo america utilizar
    function borrarDatos_post()
    {
        //recibir los names de input desde la vista por post
        $codigo = $this->post("txtCodigo");
        if ($this->clTipoAccion->borrarDatos($codigo))
            $this->response(array('status' => 'Eliminado con exito'));
        else
            $this->response(array('status' => 'fallo'));
    }
}
