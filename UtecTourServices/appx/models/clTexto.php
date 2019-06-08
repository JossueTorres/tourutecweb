<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class clTexto extends CI_Model {

	public function getListaTextos($filtros) { 
        $result = $this->db->query("CALL sp_crud_texto(1, ?, ?, ?, ?)", $filtros);
        return $result->result();
    }

    public function guardarDatos($id, $data){
        $this->db->where('tex_codsec', $id['sec']);
        $this->db->where('tex_codidm', $id['idm']);
        $res = $this->db->get('adm_tex_texto');
        if ($this->db->affected_rows() > 0) {
            $stored_procedure = "CALL sp_crud_texto(3, ?, ?, ?, ?)";
        }else {
            $stored_procedure = "CALL sp_crud_texto(2, ?, ?, ?, ?)";
        }        
        $result = $this->db->query($stored_procedure, $data);
        return $result;
    }

    //Este no es un delete a la bd sino que update de estado: activo/inactivo
    public function borrarDatos($data) {        
        $stored_procedure = "CALL sp_crud_texto(4, ?, ?, ?, ?)";
        $result = $this->db->query($stored_procedure, $data);
        return $result;
    }

}