<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clIdiomas extends CI_Model {

	public function getListaIdiomas($filtros) { 
        $result = $this->db->query("CALL sp_crud_idiomas(1, ?, ?, ?, ?)", $filtros);
        return $result->result();
    }

    public function guardarDatos($id, $data){
        if (!empty($id) && $id > 0) {
            $stored_procedure = "CALL sp_crud_idiomas(3, ?, ?, ?, ?)";
        }else {
            $stored_procedure = "CALL sp_crud_idiomas(2, ?, ?, ?, ?)";
        }        
        $result = $this->db->query($stored_procedure, $data);
        return $result;
    }

    //Este no es un delete a la bd sino que update de estado: activo/inactivo
    public function borrarDatos($id) {
        $data = array(
            'cod' => $id,
            'nom' => 0,
            'ico' => 0,            
            'aud' => ''
          );
        $stored_procedure = "CALL sp_crud_idiomas(4, ?, ?, ?, ?)";
        $result = $this->db->query($stored_procedure, $data);
        return $result;
    }

}