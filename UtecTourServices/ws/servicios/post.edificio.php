<?php
// Incluir la clase de base de datos
include_once("../classes/class.Database.php");


date_default_timezone_set('America/Mexico_City');
$fechaServer =  date("Y-m-d H:i:s"); 

$dbedf_codigo = $_POST['dbedf_codigo'];
$dbedf_nombre = $_POST['dbedf_nombre'];
$dbedf_acronimo = $_POST['dbedf_acronimo'];

//
if ( $id == 0){

$sql = "INSERT INTO `adm_edf_edificios`( `edf_nombre`, `edf_acronimo`)  values ('$dbedf_nombre','$dbedf_acronimo')";
}else{
 $sql = "UPDATE `adm_edf_edificios` SET `edf_nombre`='$dbedf_nombre',`edf_acronimo`='$dbedf_acronimo' where edf_codigo = $dbedf_codigo";
};

$hecho = Database::ejecutar_idu($sql);

if ($hecho){

$respuesta = json_encode( 

			array('err' => false, 
				  'mensaje' => "creado corectamente")
		);
	
}else{
	$respuesta = json_encode( 
				array('err' => true, 
				  'mensaje' => $hecho)
		);
	
}




echo $respuesta;



?>