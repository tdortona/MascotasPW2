<?php  	
	// las clases del objeto base de datos y usuario 
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");

	//se setea una variable mail con el valor de de la cookie
	$mail = $_COOKIE["mail"];

	//se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
	$database = new BaseDeDatos();

	//se crea una array
	$output = array(); 

	//select para devolver el nombre y el id de las mascotas de la tabla mascota anidada con la tabla usaurio (el idUsuario de mascota con el id de usaurio) usando el mail del usuario activo en el where
	$queryMascotasDelUsuario = "select mascota.nombre as nombre, mascota.id as id from mascota inner join usuario ON mascota.idUsuario=usuario.id where usuario.mail= '$mail' "; 

	//resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
	$resultado = $database->ejecutarQuery($queryMascotasDelUsuario) ;

	//empieza a recorrer las filas
	while($row = $resultado->fetch_array())  
	{  
		//se empieza a agregar cada reguistro al array
		$output[] = $row;  
	}  

	echo json_encode($output);  
?>  