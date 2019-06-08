<?php
// Incluir la clase de base de datos
include_once("../classes/class.Database.php");


date_default_timezone_set('America/Mexico_City');
$fechaServer =  date("Y-m-d H:i:s"); 


if ( isset($_GET["dbedf_codigo"]) ) {
	$dbedf_codigo = $_GET['dbedf_codigo'];	
if( is_numeric( $dbedf_codigo ) ){

	}else{
			$dbedf_codigo = 0;
	}
}else{
			$dbedf_codigo = 0;
	}
//

 $sql = "UPDATE `adm_edf_edificios` SET `edf_est_reg`='B' where edf_codigo = $dbedf_codigo";


$hecho = Database::ejecutar_idu($sql);

$hecho = Database::ejecutar_idu($sql);

if ($hecho){

$respuesta = json_encode( 

			array('err' => false, 
				  'mensaje' => "Eliminado corectamente")
		);
	
}else{
	$respuesta = json_encode( 
				array('err' => true, 
				  'mensaje' => $hecho)
		);
	
}




echo $respuesta;



?>