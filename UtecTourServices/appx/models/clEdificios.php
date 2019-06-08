<?php
class clEdificios extends CI_Model
{

  public function __construct()
  {
    $this->load->database();
    $this->tblName = 'adm_edf_edificio';
  }
  //API call - get all user record
  public function getEdificios($filtros)
  {
    $result = $this->db->query("CALL sp_crud_edificios(1, ?, ?, ?, ?, ?, ?, ?);", $filtros);
    return $result->result();
  }

  //API call - add/update user record
  public function guardarDatos($id, $data)
  {
    if (!empty($id) && $id > 0) {
      $sp = "CALL sp_crud_edificios(3, ?, ?, ?, ?, ?, ?, ?)";
    } else {
      $sp = "CALL sp_crud_edificios(2, ?, ?, ?, ?, ?, ?, ?)";
    }
    $result = $this->db->query($sp, $data);
    return $result;
  }

  //API call - delete a user record
  public function borrarDatos($id)
  {
    $data = array(
      'cod' => $id,
      'nom' => '',
      'orde' => 0,
      'lat' => 0,
      'lon' => 0,
      'acr' => '',
      'img' => ''
    );
    $result = $this->db->query("CALL sp_crud_edificios(4, ?, ?, ?, ?, ?, ?, ?)", $data);
    return $result;
  }
}
