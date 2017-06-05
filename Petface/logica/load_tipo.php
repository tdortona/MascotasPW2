<!-- php para cargar todas los tipos para usarlo en un script de angular -->
<?php  
	//query de conexion
	$connect = mysqli_connect("localhost", "root", "", "petfacepw2"); 
	//se crea una array 
	$output = array(); 
	//selecte para devolver todos los campos de la tabla tipo ordenado de manera ascendente
	$query = "SELECT * FROM tipo ORDER BY tipo ASC";  
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