<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clRecursos extends CI_Model {

	public function getListaRecursos($filtros) { 
        $result = $this->db->query("CALL sp_crud_recursos(1, ?, ?, ?, ?, ?)", $filtros);
        return $result->result();
    }

    public function guardarDatos($id, $data){
        if (!empty($id) && $id > 0) {
            $stored_procedure = "CALL sp_crud_recursos(3, ?, ?, ?, ?, ?)";
        }else {
            $stored_procedure = "CALL sp_crud_recursos(2, ?, ?, ?, ?, ?)";
        }        
        $result = $this->db->query($stored_procedure, $data);
        return $result;
    }

    //Este no es un delete a la bd sino que update de estado: activo/inactivo
    public function borrarDatos($id) {  
        $data = array(
            'cod' => $id,
            'sec' => 0,
            'idm' => 0,
            'url' => '',
            'tip' => '',
        );      
        $stored_procedure = "CALL sp_crud_recursos(4, ?, ?, ?, ?, ?)";
        $result = $this->db->query($stored_procedure, $data);
        return $result;
    }

}