<?php
// Incluir la clase de base de datos
include_once("../classes/class.Database.php");




 $sql = "select lab_codigo, lab_nombre, sum(1) Maquinas,lab_latitud,lab_longitud from adm_lab_laboratorio";
        $sql .= " join adm_maq_maquinas on lab_codigo = maq_codlab";
        $sql .= " join adm_cop_configura_practica on cop_codlab = lab_codigo";
        $sql .= " WHERE maq_estado_reserva = 'D'";
        $sql .= " AND date(cop_fecha_hora_inicia) <= date(NOW())";
        $sql .= " AND date(cop_fecha_hora_fin) >= date(NOW())";
        $sql .= " AND time(cop_fecha_hora_inicia) <= time(NOW())";
        $sql .= " AND time(cop_fecha_hora_fin) >= time(NOW())";
        $sql .= " AND cop_est_reg = 'A'";
        $sql .= " AND maq_estado_maquina = 'A'";
        $sql .= " AND ((WEEKDAY(NOW()) = 0 AND cop_lunes = 2)";
        $sql .= " OR (WEEKDAY(NOW()) = 1 AND cop_martes = 2)";
        $sql .= " OR (WEEKDAY(NOW()) = 2 AND cop_miercoles = 2)";
        $sql .= " OR (WEEKDAY(NOW()) = 3 AND cop_jueves = 2)";
        $sql .= " OR (WEEKDAY(NOW()) = 4 AND cop_viernes = 2)";
        $sql .= " OR (WEEKDAY(NOW()) = 5 AND cop_sabado = 2)";
        $sql .= " OR (WEEKDAY(NOW()) = 6 AND cop_domingo = 2))";
        $sql .= " group by lab_nombre";

$maquinas = Database::get_arreglo( $sql );


$respuesta = array(
			'error' => false,
			'maquinas' => $maquinas 
		);


 echo json_encode( $respuesta );


?>