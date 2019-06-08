<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funciones extends CI_Model {
    public function __construct()
    {
      $this->load->database();
      $this->edificio = 'adm_edf_edificio';
      $this->idioma = 'adm_idm_idioma';
      $this->recurso = 'adm_rec_recursos';
      $this->seccion = 'adm_sec_seccion';
      $this->texto = 'adm_tex_texto';
      $this->tipoaccion = 'sec_tia_tipo_accion';
      $this->usuario = 'sec_usr_usuarios';
    }

    public function login($usr, $pass){
        $this->db->where('usr_correo',$usr);
        $this->db->where('usr_contrasena', $pass);
        $res = $this->db->get($this->usuario);
        if ($this->db->affected_rows() > 0) {
            return $res->result();
        }else {
            return false;
        }
    }

}