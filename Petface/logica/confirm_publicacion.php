<!-- php para confirmar la publicacion hecha por el perfil de la mascota -->
<?php

	//se define la zona horaria de argentina
	date_default_timezone_set('America/Argentina/Buenos_Aires');
	//se recupera los valores pasado por post y se los pasa a unas variables
	$texto=$_POST["texto"];
	$idMascota=$_POST["idMascota"];
	@$pathImagen="Imagen Publicacion";
	@$archivo=$_FILES['pathImagen']['tmp_name'];
	@$nombreArchivo=$_FILES['pathImagen']['name'];
	move_uploaded_file($archivo,$pathImagen."/".$nombreArchivo);
	@$pathImagen=$pathImagen."/".$nombreArchivo;
	//se recupera la fecha y hora actual y se la pasa a una variable
	$fechaPublicacion=date('Y-m-d H:i:s');

	//query de conexion
	$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
	//insert para agregar un registro a la tabla publicacion pasandole las vaiables definidas al principio
	$sql= "INSERT INTO publicacion VALUES ('','$idMascota','','$texto','$pathImagen','','$fechaPublicacion')";
	//query del resultado
	$result=mysqli_query($conexion,$sql) or die("no se agrego la fila");
	//reguesa al perfil de la mascota pasandole por variable el id de la mascota para regresar al mismo perfil	
	header("location:../perfilMascota.php?nombreMascota=".$idMascota."");

	$conexion->close();

?>

