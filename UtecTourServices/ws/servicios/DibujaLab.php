<?php
// Incluir la clase de base de datos
include_once("../classes/class.Database.php");


date_default_timezone_set('America/Mexico_City');
$fechaServer =  date("Y-m-d H:i:s"); 


if ( isset($_GET["dblab_codigo"]) ) {
	$dblab_codigo = $_GET['dblab_codigo'];	
if( is_numeric( $dblab_codigo ) ){

	}else{
			$dblab_codigo = 0;
	}
}else{
			$dblab_codigo = 0;
	}
//busco el laboratorio
$sql = "SELECT * FROM adm_lab_laboratorio where lab_est_reg = 'A' and lab_codigo = $dblab_codigo ";

$lab = Database::get_arreglo( $sql );
$hecho = false;
$alias =  $lab[0]['lab_acronimo'];
if($lab[0]['lab_codigo'] > 0){
	//$sql = "UPDATE `adm_maq_maquinas` SET `maq_est_reg`='B' where maq_codlab = $dblab_codigo";
	//$hec2 = Database::ejecutar_idu($sql);
	$sqlMaq = "DELETE FROM adm_maq_maquinas where maq_codlab = $dblab_codigo ";
	$maq = Database::ejecutar_idu( $sqlMaq );
	for ($i =1; $i <= $lab[0]['lab_filas']; $i++) { 
		for ($j=1; $j <= $lab[0]['lab_columnas']; $j++) { 
			
				$sql = "INSERT INTO `adm_maq_maquinas` (`maq_codlab`, `maq_fila`, `maq_columna`, `maq_estado_maquina`, `maq_estado_reserva`, `maq_est_reg` , `maq_alias`) VALUES ($dblab_codigo,$i,$j,'A','I','A','$alias')";
			
			$hecho = Database::ejecutar_idu($sql);
			
		}
	}
}


if ($hecho){

$respuesta = json_encode( 

			array('err' => false, 
				  'mensaje' => "Maquinas creadas corectamente")
		);
	
}else{
	$respuesta = json_encode( 
				array('err' => true, 
				  'mensaje' => $hecho)
		);
	
}




echo $respuesta;
