<?php
	include_once("clases/BaseDeDatos.php");
    include_once("clases/Usuario.php");
    $database = new BaseDeDatos();

	$campo = $_POST["campo"];
	$valor = $_POST["valor"];

	$query = "select * from usuario where $campo = '$valor' ";

	$resultado =  $database->ejecutarQuery($query) ;

	if ( $resultado->num_rows ) {
		echo 'true';
	} else {
		echo 'false';
	}
?>