<!-- php para cargar todas las mascotas que tenga el dueño para usarlo en un script de angular --> <!-- IMPORTANTE!!!! DE MOMENTO NO SE USA PERO SE GUARDA POR SI ACASO -->
<?php  
	//query de conexion
	$connect = mysqli_connect("localhost", "root", "", "petfacepw2");  
	//se crea una array
	$output = array(); 
	//se setea el mail del usuario activo por medio de la cookie a una variable
	$mail = $_COOKIE["mail"]; 
	//select para devolver el nombre y el id de las mascotas de la tabla mascota anidada con la tabla usaurio (el idUsuario de mascota con el id de usaurio) usando el mail del usuario activo en el where
	$query = "SELECT mascota.nombre as nombre, mascota.id as id FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id where usuario.mail= '$mail' "; 
	//query resultado
	$result = mysqli_query($connect, $query);
	//se empieza a recorrer el resultado  
	while($row = mysqli_fetch_array($result))  
	{  
		//se empieza a agregar cada reguistro al array
		$output[] = $row;  
	}  
	echo json_encode($output);  
?>  