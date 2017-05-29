

<?php

	$texto=$_POST["texto"];

	@$pathImagen="Imagen Publicacion";
	@$archivo=$_FILES['pathImagen']['tmp_name'];
	@$nombreArchivo=$_FILES['pathImagen']['name'];
	move_uploaded_file($archivo,$pathImagen."/".$nombreArchivo);
	@$pathImagen=$pathImagen."/".$nombreArchivo;


	$fechaRegistro=date('Y-m-d');
	/*$estado=0;*/
	
	$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");

	$sql= "SELECT * FROM publicacion";

	$result = mysqli_query($conexion,$sql);
	$result2 = mysqli_query($conexion,$sql);

			/* -------------------- */

	if ($password==$rePassword)
        {
        	$estado=1;
        	
        }
        else
        {
        	$estado=0;
        	session_start();
        	$_SESSION["texto"]=$texto;
        	$_SESSION["errorTipo"]="contraseña";
        	header("location:../registro.php");
        	break;
        }    
        
    

    if ($estado==1)
    {
    	while($row = mysqli_fetch_assoc($result2)) 
	    {
		    if ($row["mail"]!=$mail)
		    {
		    	$estado=1;
		    }
		    else
		    {
		       $estado=0;
        	session_start();
			$_SESSION["texto"]=$texto;
        	$_SESSION["errorTipo"]="mail";
        	header("location:../registro.php");
        	break;
		    }
		}
    }
	    
	if ($estado==1)
	{



		/* -------------------- */



	$sql= "INSERT INTO publicacion VALUES ('','$idMascota','','$texto','$pathImagen','')";
		$result=mysqli_query($conexion,$sql) or die("no se agrego la fila");
		session_start();
		$_SESSION["nombre"]=$nombre;
		header("location:../home.php");

		/* -------------------- */


		}


		/* -------------------- */
	$conexion->close();

?>

<?php echo "<a href=\"../registroMascota.php\">volver</a>" ?>