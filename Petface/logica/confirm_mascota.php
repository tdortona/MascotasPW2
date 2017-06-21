<!-- php para registrar mascota -->
<?php
	//las clases del objeto base de datos y usuario
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");
	//posiciona la fecha y hora de argentina
	date_default_timezone_set('America/Argentina/Buenos_Aires');

	//se setea una variable mail con el valor de de la cookie
	$mail = $_COOKIE["mail"];

	//se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
	$database = new BaseDeDatos();

	//query para recuperar el id del usuario activo de la tabla usuario usando en el where su mail guardado en la cookie
	$queryIdUsuarioActivo= "select id from usuario where mail= '$mail' ";
	//resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
	$resultado =  $database->ejecutarQuery($queryIdUsuarioActivo) ;
	//se verifica si se encuentra resultados en la query para recuperar el id del usuario activo
	if ($resultado->num_rows>0) 
    {
    	//empieza a recorrer las filas
	    while($fila = $resultado->fetch_assoc()) 
	    {
	    	//le asigna a una variable el id del usuario activo
	    	$idDueño=$fila["id"];
	    }
    }

    //setea todas las variables con los valores que se le paso por el post
	$nombre=$_POST["nombre"];
	$tipo=$_POST["tipo"];
	$raza=$_POST["raza"];
	$sexo=$_POST["sexo"];
	$fechaRegistro=date('Y-m-d');
	//se recupera la el valor de la fecha de nacimiento, se cambia las / por - para que coincida con la base de datos y por ultimo se cambia el orden de los numeros para que coincidan con la base de datos
	$fechaNacimiento=date('Y-m-d',strtotime( str_replace('/', '-', $_POST["fechaNacimiento"])));

	//variable para guardar el archivo 
	$archivo=$_FILES['imagen']['tmp_name'];
	//variable que guarda el formato del archivo
	$fileType = $_FILES["imagen"]["type"];
	//variable que guarda el nombre del archivo: primero se pone la fecha actial, despues se pone el string "PerfilMascota", se le adiere un string unico basado en la hora actual en milesimas y por ultimo el formato del archivo
	$nombreArchivo=date('Y-m-d')."PerfilMascota".uniqid('', true).str_replace('/', '.', $fileType);
	//se mueve la imagen al destino indicado con el nuevo nombre
	move_uploaded_file($archivo,"Imagen Mascota/".$nombreArchivo);
	//se guarda la ruta donde esta la imagen
	$imagen="Imagen Mascota/".$nombreArchivo;

	
	

	//query para agregar la mascota a la base de datos
	$queryInsertMascota= "insert into mascota values ('','$idDueño','$nombre','$tipo','$raza','$sexo','$fechaNacimiento','','$imagen',1,'$fechaRegistro')";
	//se ejecuta la query
	$database->ejecutarQuery($queryInsertMascota) ;

	//cuando la mascota se registra genera una primera publicacion

	//query para recuperar el id nuevo de la mascota recien agregada recuperando el id de la tabla mascota anidada con la tabla usuario (mascota.idUsuario=usuario.id) usando en el where el mail del usuario ordenado de manera desendiente recuperando solo el primer resultado
	$queryIdNuevaMascota="select mascota.id as id from mascota inner join usuario on mascota.idUsuario=usuario.id where usuario.mail= '$mail' order by mascota.id desc limit 1";

	//resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
	$resultado =  $database->ejecutarQuery($queryIdNuevaMascota) ;

	//se verifica si se encuentra resultados en la query para recuperar el id de la mascota recien registrada
	if ($resultado->num_rows>0) 
    {
    	//empieza a recorrer las filas
		while($fila = $resultado->fetch_assoc()) 
		{
			//le asigna a una variable el id de la mascota recien registrada
			$idMascota=$fila["id"];
		}
    }

    //se recupera la fecha y hora actual y se la pasa a una variable
	$fechaPublicacion=date('Y-m-d H:i:s');

	//query para agregar la publicacion
	$queryGuardarPublicacion= "insert into publicacion values ('','$idMascota','','$nombre se ha unido a PetFace!','','','$fechaPublicacion')";

	//se ejecuta la query
	$database->ejecutarQuery($queryGuardarPublicacion) ;

	//se redirige al perfil de la mascota recien creada	
	header("location:../perfilMascota.php?nombreMascota=".$idMascota);

?>

