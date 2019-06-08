<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clSeccion extends CI_Model {

	public function getListaSeccion($filtros) { 
        $result = $this->db->query("CALL sp_crud_seccion(1,?,?,?,?,?,?)", $filtros);
        return $result->result();
    }

    public function guardarDatos($id, $data){
        if (!empty($id) && $id > 0) {
            $stored_procedure = "CALL sp_crud_seccion(3,?,?,?,?,?,?)";
        }else {
            $stored_procedure = "CALL sp_crud_seccion(2,?,?,?,?,?,?)";
        }        
        $result = $this->db->query($stored_procedure, $data);
        return $result;
    }

    //Este no es un delete a la bd sino que update de estado: activo/inactivo
    public function borrarDatos($id) {
        $data = array(
            'cod' => $id,
            'edf' => 0,
            'orde' => 0,            
            'nom' => '',            
            'lat' => 0,
            'lon' => 0,
            'est' => ''
          );
        $stored_procedure = "CALL sp_crud_seccion(4,?,?,?,?,?,?)";
        $result = $this->db->query($stored_procedure, $data);
        return $result;
    }

}