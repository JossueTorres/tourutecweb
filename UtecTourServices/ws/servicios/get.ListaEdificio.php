<?php
// Incluir la clase de base de datos
include_once("../classes/class.Database.php");



$sql = "SELECT * FROM adm_maq_maquinas ";

$data = Database::get_arreglo( $sql );


$respuesta = array(
			'error' => false,
			'data' => $data 
		);


 echo json_encode( $respuesta );


?>