<?php 
	//las clases del objeto base de datos y usuario
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");

	//GEOLOCALIZACIÓN
	//se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
	$database = new BaseDeDatos();

	
	//setea todas las variables con los valores que se le paso por el post
	$nombre=$_POST["nombre"];
	$mail=$_POST["mail"];
	$password=$_POST["password"];
	$rePassword=$_POST["confirmaPassword"];
	$telefono=$_POST["telefono"];
	$sexo=$_POST["sexo"];
	$mensaje=0;
	$ubicacion=$_POST["ubicacion"];
	$latitud=$_POST["lat"];
	$longitud=$_POST["lng"];
	$fechaRegistro=date('Y-m-d');
	//se recupera la el valor de la fecha de nacimiento, se cambia las / por - para que coincida con la base de datos y por ultimo se cambia el orden de los numeros para que coincidan con la base de datos
	$fechaNacimiento=date('Y-m-d',strtotime( str_replace('/', '-', $_POST["fechaNacimiento"])));
	
	//variable para guardar el archivo 
	$archivo=$_FILES['imagen']['tmp_name'];
	//variable que guarda el formato del archivo
	$fileType = $_FILES["imagen"]["type"];
	//variable que guarda el nombre del archivo: primero se pone la fecha actial, despues se pone el string "PerfilUsuario", se le adiere un string unico basado en la hora actual en milesimas y por ultimo el formato del archivo
	$nombreArchivo=date('Y-m-d')."PerfilUsuario".uniqid('', true).str_replace('/', '.', $fileType);
	//se mueve la imagen al destino indicado con el nuevo nombre
	move_uploaded_file($archivo,"Imagen Usuario/".$nombreArchivo);
	//se guarda la ruta donde esta la imagen
	$imagen="Imagen Usuario/".$nombreArchivo;

	//variable que sirve para verificar que todos los pasos estan saliendo bien. Si esta en 1 todo va bien, si se pone en 0 algo salio mal e impide que las demas acciones no se realicen
	$estado=0;

	
	//la primera validacion es que la contraseña sea igual a su confirmacion
    if ($password==$rePassword)
    {	
    	//si es igual, deja el valor de la varible en 1
    	$estado=1;	
    }
    else
    {
   		//si las contraseñas no coincidieron, pone el estado en 0, evitando que entre en los demas IF, setea variables de sesion para pasarle informacion de vuelta al registro
    	$estado=0;
    	session_start();
    	$_SESSION["telefono"]=$telefono;
    	$_SESSION["fechaNacimiento"]=$_POST["fechaNacimiento"];
    	$_SESSION["nombre"]=$nombre;
    	$_SESSION["sexo"]=$sexo;
    	$_SESSION["imagen"]=$_POST["imagen"];
    	$_SESSION["direccion"]=$_GET["direccion"];
    	$localizacion=$_POST["localizacion"];
    	$_SESSION["errorTipo"]="contraseña";
    	header("location:../registro.php");	
    }   

	//select para que traiga todos los usuarios
	$query= "select * from usuario"; 

	//la siguiente validacion es para comprobar que el mail no esta repetido
	if ($estado==1)
	{	
		//resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
		$resultado =  $database->ejecutarQuery($query) ;

		//si encuentra filas, las empieza a recorrer
		while($row = $resultado->fetch_assoc())
	    {
	    	//si el mail del registro es distinto al de la fila actual, setea el valor del estado en 1 y continua con la siguiente 
		    if ($row["mail"]!=$mail)
		    {
		    	$estado=1;
		    }
		    else
		    {
		    	//si los mailos coinciden, pone el estado en 0, evitando que entre en los demas IF, setea variables de sesion para pasarle informacion de vuelta al registro y sale del while con un break
				$estado=0;
				session_start();
				$_SESSION["telefono"]=$telefono;
				$_SESSION["fechaNacimiento"]=$_POST["fechaNacimiento"];
				$_SESSION["nombre"]=$nombre;
				$_SESSION["sexo"]=$sexo;
				$_SESSION["direccion"]=$_GET["direccion"];
				$localizacion=$_POST["localizacion"];
				$_SESSION["imagen"]=$imagen;
				$_SESSION["errorTipo"]="mail";
				header("location:../registro.php");
				break;
		    }
		}
	}
	 
	//si finalmente el estado sigue en 1, hace el trabajo de agregar el nuevo usuario a la db 
	if ($estado==1)
	{
		 $password = md5($password);
        //query de insersion del nuevo usuario
        $insert_query= "insert into usuario values ('','$mail','$password','$nombre','$fechaNacimiento','$sexo','$imagen',$telefono,'$fechaRegistro','$mensaje','$ubicacion','$latitud','$longitud')";
		//ejecuta el metodo que ejecuta la query
		$database->ejecutarQuery($insert_query);
		//inicia sesion para pasarle valores a la pagina correcto.php
		session_start();
		$_SESSION["nombre"]=$nombre;
		$_SESSION["mail"]=$mail;
		
		//redirige a correcto.php
		header("location:../correcto.php");
	}


?>

