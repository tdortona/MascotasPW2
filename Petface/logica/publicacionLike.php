<?php
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");
	
	$idPublicacion = $_POST["idPublicacion"];
	$idUsuario = $_POST["idUsuario"];
	$like = $_POST["like"];
	$comentario = $_POST["comentario"];
	$idMascota = $_POST["idMascota"];
	
	$database = new BaseDeDatos();
	
	$queryGuardarLike = "INSERT INTO likepublicacion (`idUsuario`, `idPublicacion`, `like`, `comentario`, `idMascota`)
						 VALUES ('$idUsuario', '$idPublicacion', '$like', '$comentario', '$idMascota')";
	$resultado = $database->ejecutarQuery($queryGuardarLike);
?>