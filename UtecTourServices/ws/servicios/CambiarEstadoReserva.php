<?php
// Incluir la clase de base de datos
include_once("../classes/class.Database.php");


date_default_timezone_set('America/Mexico_City');
$fechaServer =  date("Y-m-d H:i:s"); 


if ( isset($_GET["lab"]) ) {$dbmaq_codlab = $_GET['lab'];
if( is_numeric( $dbmaq_codlab ) ){}else{$dbmaq_codlab = 0;}
}else{$dbmaq_codlab = 0;} 

if ( isset($_GET["fil"]) ) {$dbmaq_fila = $_GET['fil'];	
if( is_numeric( $dbmaq_fila ) ){}else{$dbmaq_fila = 0;}
}else{$dbmaq_fila = 0;}

if ( isset($_GET["col"]) ) {$dbmaq_columna = $_GET['col'];	
if( is_numeric( $dbmaq_columna ) ){}else{$dbmaq_columna = 0;}
}else{$dbmaq_columna = 0;}
if ( isset($_GET["est"]) ) {
	$dbmaq_estado_reserva = $_GET['est'];
}else{
	$dbmaq_estado_reserva = 'I';
}

//
$hecho = false;
$hecho2 = false;
if ( $dbmaq_codlab > 0  && $dbmaq_fila > 0 && $dbmaq_columna > 0 ){

	$sql = "UPDATE `adm_maq_maquinas` SET `maq_estado_reserva`='$dbmaq_estado_reserva' where maq_codlab = $dbmaq_codlab and maq_fila = $dbmaq_fila and maq_columna = $dbmaq_columna";
	$sql2 ="INSERT INTO `practicas_lab`.`adm_rac_registro_actividad` ( `rac_codlab`, `rac_fila`, `rac_columna`, `rac_fecha`,`rac_tipo`) VALUES ( $dbmaq_codlab, $dbmaq_fila, $dbmaq_columna, '$fechaServer','$dbmaq_estado_reserva'); ";
	$hecho = Database::ejecutar_idu($sql);
	$hecho2 = Database::ejecutar_idu($sql2);
};

if ($hecho){

$respuesta = json_encode( 

			array('err' => false, 
				  'mensaje' => "cambio corectamente")
		);
	
}else{
	$respuesta = json_encode( 
				array('err' => true, 
				  'mensaje' => $hecho)
		);
	
}




echo $respuesta;
?>