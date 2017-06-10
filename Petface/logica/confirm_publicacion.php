<?php
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");

	date_default_timezone_set('America/Argentina/Buenos_Aires');
	
	$texto=$_POST["texto"];
	$idMascota=$_POST["idMascota"];
	
	if ($_FILES['pathImagen']['name']!="")
	{
		$archivoImagen=$_FILES['pathImagen']['tmp_name'];
		$fileTypeImagen = $_FILES["pathImagen"]["type"];
		$nombreArchivoImagen=date('Y-m-d')."PublicacionImagen".uniqid('', true).str_replace('/', '.', $fileTypeImagen);
		move_uploaded_file($archivoImagen,"Imagen Publicacion/".$nombreArchivoImagen);
		$imagenPath="Imagen Publicacion/".$nombreArchivoImagen;
	}
	else
	{
		$imagenPath="";
	}
	

	if ($_FILES['pathVideo']['name']!="")
	{
		$archivoVideo=$_FILES['pathVideo']['tmp_name'];
		$fileTypeVideo = $_FILES["pathVideo"]["type"];
		$nombreArchivoVideo=date('Y-m-d')."PublicacionVideo".uniqid('', true).$_FILES['pathVideo']['name'];
		move_uploaded_file($archivoVideo,"Video Publicacion/".$nombreArchivoVideo);
		$videoPath="Video Publicacion/".$nombreArchivoVideo;
	}
	else
	{
		$videoPath="";
	}

	$fechaPublicacion=date('Y-m-d H:i:s');
	
	$database = new BaseDeDatos();

	$queryGuardarPublicacion= "insert into publicacion values ('','$idMascota','','$texto','$imagenPath','$videoPath','$fechaPublicacion')";
		$resultado=$database->ejecutarQuery($queryGuardarPublicacion) ;
		
		header("location:../perfilMascota.php?nombreMascota=".$idMascota."");

?>

<?php echo "<a href=\"../registroMascota.php\">volver</a>" ?>