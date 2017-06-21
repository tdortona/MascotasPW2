<?php
	// las clases del objeto base de datos y usuario 
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");

	//posiciona la fecha y hora de argentina
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	
	//se recupera los valores pasado por post y se los pasa a unas variables
	$texto=$_POST["texto"];
	$idMascota=$_POST["idMascota"];
	$fechaPublicacion=date('Y-m-d H:i:s');

	//revisa si existe algun archivo subido a la parte de imagen
	if ($_FILES['pathImagen']['name']!="")
	{
		//variable para guardar el archivo 
		$archivoImagen=$_FILES['pathImagen']['tmp_name'];
		//variable que guarda el formato del archivo
		$fileTypeImagen = $_FILES["pathImagen"]["type"];
		//variable que guarda el nombre del archivo: primero se pone la fecha actial, despues se pone el string "PublicacionImagen", se le adiere un string unico basado en la hora actual en milesimas y por ultimo el formato del archivo
		$nombreArchivoImagen=date('Y-m-d')."PublicacionImagen".uniqid('', true).str_replace('/', '.', $fileTypeImagen);
		//se mueve la imagen al destino indicado con el nuevo nombre
		move_uploaded_file($archivoImagen,"Imagen Publicacion/".$nombreArchivoImagen);
		//se guarda la ruta donde esta el video
		$imagenPath="Imagen Publicacion/".$nombreArchivoImagen;
	}
	//si no hay ningun archivo subido le asigna el nombre default 
	else
	{
		$imagenPath="";
	}
	
	//revisa si existe algun archivo subido a la parte del video
	if ($_FILES['pathVideo']['name']!="")
	{
		//variable para guardar el archivo 
		$archivoVideo=$_FILES['pathVideo']['tmp_name'];
		//variable que guarda el formato del archivo
		$fileTypeVideo = $_FILES["pathVideo"]["type"];
		//variable que guarda el nombre del archivo: primero se pone la fecha actial, despues se pone el string "PublicacionVideo", se le adiere un string unico basado en la hora actual en milesimas y por ultimo el formato del archivo
		$nombreArchivoVideo=date('Y-m-d')."PublicacionVideo".uniqid('', true).$_FILES['pathVideo']['name'];
		//se mueve la imagen al destino indicado con el nuevo nombre
		move_uploaded_file($archivoVideo,"Video Publicacion/".$nombreArchivoVideo);
		//se guarda la ruta donde esta el video
		$videoPath="Video Publicacion/".$nombreArchivoVideo;
	}
	//si no hay ningun archivo subido le asigna el nombre default
	else
	{
		$videoPath="";
	}

	//se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys	
	$database = new BaseDeDatos();

	//query para agregar la publicacion
	$queryGuardarPublicacion= "insert into publicacion values ('','$idMascota','','$texto','$imagenPath','$videoPath','$fechaPublicacion')";

	//se ejecuta la query
	$database->ejecutarQuery($queryGuardarPublicacion) ;
		
	//se redirige al perfil de la mascota
	header("location:../perfilMascota.php?nombreMascota=".$idMascota."");

?>

