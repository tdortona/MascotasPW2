<?php 
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");

	$nombre=$_POST["nombre"];
	$telefono=$_POST["telefono"];
	$password=$_POST["password"];
	$rePassword=$_POST["confirmaPassword"];
	$fechaNacimiento=date('Y-m-d',strtotime( str_replace('/', '-', $_POST["fechaNacimiento"])));
	$mail=$_POST["mail"];
	$sexo=$_POST["sexo"];
	$fechaRegistro=date('Y-m-d');

	$archivo=$_FILES['imagen']['tmp_name'];
	$fileType = $_FILES["imagen"]["type"];
	$nombreArchivo=date('Y-m-d')."PerfilUsuario".uniqid('', true).str_replace('/', '.', $fileType);
	move_uploaded_file($archivo,"Imagen Usuario/".$nombreArchivo);
	$imagen="Imagen Usuario/".$nombreArchivo;

	$estado=0;


	$database = new BaseDeDatos();
	$query= "select * from usuario";
	
        if ($password==$rePassword)
        {
        	$estado=1;
        	
        }
        else
        {
        	$estado=0;
        	session_start();
        	$_SESSION["telefono"]=$telefono;
        	$_SESSION["fechaNacimiento"]=$_POST["fechaNacimiento"];
        	$_SESSION["nombre"]=$nombre;
        	$_SESSION["sexo"]=$sexo;
        	$_SESSION["imagen"]=$_POST["imagen"];
        	$_SESSION["errorTipo"]="contraseña";
        	header("location:../registro.php");
        	
        }    
        
    

   if ($estado==1)
    {
    	$resultado =  $database->ejecutarQuery($query) ;
    	while($fila = $resultado->fetch_assoc())
	    {
		    if ($fila["mail"]!=$mail)
		    {
		    	
		    	$estado=1;
		    }
		    else
		    {
		       $estado=0;
        	session_start();
			$_SESSION["telefono"]=$telefono;
        	$_SESSION["fechaNacimiento"]=$_POST["fechaNacimiento"];
        	$_SESSION["nombre"]=$nombre;
        	$_SESSION["sexo"]=$sexo;
        	$_SESSION["imagen"]=$imagen;
        	$_SESSION["errorTipo"]="mail";
        	header("location:../registro.php");
        	break;
		    }
		}
    }
	    
	if ($estado==1)
	{
		$insert_query= "insert into usuario values ('','$mail','$password','$nombre','','$fechaNacimiento','$sexo','$imagen',$telefono,'$fechaRegistro')";
		$database->ejecutarQuery($insert_query);
		session_start();
		$_SESSION["nombre"]=$nombre;
		$_SESSION["mail"]=$mail;
		header("location:../correcto.php");
	}

		?>

<?php echo "<a href=\"../registro.php\">volver</a>" ?>