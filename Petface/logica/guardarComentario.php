<?php
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");
	
	$idPublicacion = $_POST["idPublicacion"];
	$idUsuario = $_POST["idUsuario"];	
	$comentario = $_POST["comentario"];
	$idMascota = $_POST["idMascota"];
	
	$database = new BaseDeDatos();
	
	$queryGuardarComentario = "UPDATE `likepublicacion`
							   SET `comentario` = '$comentario'
							   WHERE `likepublicacion`.`idUsuario` = '$idUsuario' AND `likepublicacion`.`idPublicacion` = '$idPublicacion' AND `likepublicacion`.`idMascota` = '$idMascota';";
	$resultado = $database->ejecutarQuery($queryGuardarComentario);
?>