<!-- php para registrar un usuario -->

<?php
	
	//setea todas las variables con los valores que se le paso por el post
	$nombre=$_POST["nombre"];
	$telefono=$_POST["telefono"];
	$password=$_POST["password"];
	$rePassword=$_POST["confirmaPassword"];
	//se recupera la el valor de la fecha de nacimiento, se cambia las / por - para que coincida con la base de datos y por ultimo se cambia el orden de los numeros para que coincidan con la base de datos
	$fechaNacimiento=date('Y-m-d',strtotime( str_replace('/', '-', $_POST["fechaNacimiento"])));
	$mail=$_POST["mail"];
	$sexo=$_POST["sexo"];
	//variables de la imagen
	@$imagen="Imagen Usuario";
	@$archivo=$_FILES['imagen']['tmp_name'];
	@$nombreArchivo=$_FILES['imagen']['name'];
	move_uploaded_file($archivo,$imagen."/".$nombreArchivo);
	@$imagen=$imagen."/".$nombreArchivo;
	$fechaRegistro=date('Y-m-d');
	//el estado sirve para ir verificando que todo esta yendo bien, si el estado cambia a 0 significa que algo salio mal y asi se evita que prosiga con los demas pasos que verifican el estado al principo de la accion con un if. De arranque es 0
	$estado=0;

	//provicional, si el mail o la contraseña estan vacias devuelve al index.php
	if(isset($_POST["mail"]) or $_POST["mail"]!="")
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
	}
	
	//query de conexion
	$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
	//select que devuelve todos los registros de la tabla usuario
	$sql= "SELECT * FROM usuario";
	//query del resultado
	$result = mysqli_query($conexion,$sql);
	//otra query de resultado
	$result2 = mysqli_query($conexion,$sql);

	//verificamos si la contraseñas coinciden, si no entra el else
        if ($password==$rePassword)
        {
        	//el estado es 1, se hara el siguiente paso
        	$estado=1;
        	
        }
        //no eran iguales y se empieza a setear las variables de sesiones para regresar y rellenar los campos del formulario
        else
        {
        	//el estado es 0 para impedir que se hagan los otros pasos
        	$estado=0;
        	session_start();
        	$_SESSION["telefono"]=$telefono;
        	$_SESSION["fechaNacimiento"]=$_POST["fechaNacimiento"];
        	$_SESSION["nombre"]=$nombre;
        	$_SESSION["sexo"]=$sexo;
        	$_SESSION["imagen"]=$imagen;
        	$_SESSION["errorTipo"]="contraseña";
        	header("location:../registro.php");
        	
        }    
        
    
    //verificamos si el estado es 1, si no, no hace este paso
    if ($estado==1)
    {
    	//empieza a recorrer los registros resultados 
    	while($row = mysqli_fetch_assoc($result2)) 
	    {
	    	//si el mail a registrar es distinto al mail de ese registro, si lo es continua mirando los demas registros
		    if ($row["mail"]!=$mail)
		    {
		    	//el estado es 1, se hara el siguiente paso
		    	$estado=1;
		    }
		    //si encuentra un mail igual entra al else y empieza a setear las variables de sesiones para regresar y rellenar los campos del formulario
		    else
		    {
		    	//el estado es 0 para impedir que se hagan los otros pasos
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
	    
	////verificamos si el estado es 1, si no, no hace este paso
	if ($estado==1)
	{
		//insert para insertar un nuevo registro a la tabla usando las variables seteadas al principo de todo
		$sql= "INSERT INTO usuario VALUES ('','$mail','$password','$nombre','','$fechaNacimiento','$sexo','$imagen',$telefono,'$fechaRegistro')";
		//query del resultado
		$result=mysqli_query($conexion,$sql) or die("no se agrego la fila");
		//se inicia sesion
		session_start();
		//se setea el nombre del usaurio para mostrarlo en la pagina de correcto.php
		$_SESSION["nombre"]=$nombre;
		//se setea el mail del usuraio para mostrarlo en la pagina de correcto.php
		$_SESSION["mail"]=$mail;
		header("location:../correcto.php");
	}

	//para pruebas

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

	//se cierra la conexion
	$conexion->close();

?>

<!-- link para volver al registro, solo esta con fines de quedarse en esta pagina con fines de pruebas-->
<?php echo "<a href=\"../registro.php\">volver</a>" ?>