

<?php

	$nombre=$_POST["nombre"];
	$telefono=$_POST["telefono"];
	$password=$_POST["password"];
	$rePassword=$_POST["confirmaPassword"];
	$fechaNacimiento=date('Y-m-d',strtotime( str_replace('/', '-', $_POST["fechaNacimiento"])));
	$mail=$_POST["mail"];
	$sexo=$_POST["sexo"];
	
	@$imagen="Imagen Usuario";
	@$archivo=$_FILES['imagen']['tmp_name'];
	@$nombreArchivo=$_FILES['imagen']['name'];
	move_uploaded_file($archivo,$imagen."/".$nombreArchivo);
	@$imagen=$imagen."/".$nombreArchivo;

	$fechaRegistro=date('Y-m-d');
	$estado=0;


	/*if(isset($_POST["mail"]) or $_POST["mail"]!="")
	{
		if(isset($_POST["password"]) or $_POST["password"]!="")
		{

		}
		else
		{
			header("location:../index.php");
		}
	} 
	else
	{
		header("location:../index.php");
	}*/
	
	$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");

	$sql= "SELECT * FROM usuario";

	$result = mysqli_query($conexion,$sql);
	$result2 = mysqli_query($conexion,$sql);

	
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
        	$_SESSION["imagen"]=$imagen;
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
		$sql= "INSERT INTO usuario VALUES ('','$mail','$password','$nombre','','$fechaNacimiento','$sexo','$imagen',$telefono,'$fechaRegistro')";
		$result=mysqli_query($conexion,$sql) or die("no se agrego la fila");
		session_start();
		$_SESSION["nombre"]=$nombre;
		$_SESSION["mail"]=$mail;
		header("location:../correcto.php");
	}

	/*$result3 = mysqli_query($conexion,$sql);

	if (mysqli_num_rows($result3)>0) 
	{
		echo "entro aca <br>";
		while($row2 = mysqli_fetch_assoc($result3)) 
	    {
			echo "id: " . $row2["Id"]. " - Name: " . $row2["Usuario"]. " " . "<br> \n";
		}
	} 
	else 
	{
    	echo "0 results";
	}*/


	$conexion->close();

?>

<?php echo "<a href=\"../registro.php\">volver</a>" ?>