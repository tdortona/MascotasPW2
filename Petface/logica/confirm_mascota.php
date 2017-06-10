<?php
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");

	$mail = $_COOKIE["mail"];

	$database = new BaseDeDatos();
	$queryIdUsuarioActivo= "select * from usuario where mail= '$mail' ";
	$resultado =  $database->ejecutarQuery($queryIdUsuarioActivo) ;
	if ($resultado->num_rows>0) 
    {
      while($fila = $resultado->fetch_assoc()) 
      {
        $idDueño=$fila["id"];
      }
    }

	$nombre=$_POST["nombre"];
	$fechaNacimiento=date('Y-m-d',strtotime( str_replace('/', '-', $_POST["fechaNacimiento"])));
	$tipo=$_POST["tipo"];
	$raza=$_POST["raza"];
	$sexo=$_POST["sexo"];

	$archivo=$_FILES['imagen']['tmp_name'];
	$fileType = $_FILES["imagen"]["type"];
	$nombreArchivo=date('Y-m-d')."PerfilUsuario".uniqid('', true).str_replace('/', '.', $fileType);
	move_uploaded_file($archivo,"Imagen Mascota/".$nombreArchivo);
	$imagen="Imagen Mascota/".$nombreArchivo;

	$fechaRegistro=date('Y-m-d');

	$queryInsertMascota= "insert into mascota values ('','$idDueño','$nombre','$tipo','$raza','$sexo','$fechaNacimiento','','$imagen',1,'$fechaRegistro')";

	$database->ejecutarQuery($queryInsertMascota) ;
		
	header("location:../mascotas.php");

?>

<?php echo "<a href=\"../registro.php\">volver</a>" ?>