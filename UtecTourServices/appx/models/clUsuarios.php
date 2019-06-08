<?php
class clUsuarios extends CI_Model
{

  public function __construct()
  {
    $this->load->database();
    $this->tblName = 'sec_usr_usuarios';
  }
  //API call - get all user record
  public function getListaUsuarios($filtros)
  {
    $result = $this->db->query("CALL sp_crud_usuarios(1, ?, ?, ?, ?, ?, ?);", $filtros);
    return $result->result();
  }

  //API call - add/update user record
  public function guardarDatos($id, $data)
  {
    if (!empty($id) && $id > 0) {
      $sp = "CALL sp_crud_usuarios(3, ?, ?, ?, ?, ?, ?);";
    } else {
      $sp = "CALL sp_crud_usuarios(2, ?, ?, ?, ?, ?, ?);";
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
        'con' => '',
        'conf' => '',
        'estu' => '',
        'tip' => '',
    );
    $result = $this->db->query("CALL sp_crud_usuarios(4, ?, ?, ?, ?, ?, ?);", $data);
    return $result;
  }
}
