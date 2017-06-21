<?php  	
	// las clases del objeto base de datos y usuario 
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");

	//se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
	$database = new BaseDeDatos();

	//se crea una array
	$output = array(); 

	//selecte para devolver todos los campos de la tabla tipo ordenado de manera ascendente
	$queryTipos = "select * from tipo order by tipo asc";  

	//resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
	$resultado = $database->ejecutarQuery($queryTipos) ;

	//empieza a recorrer las filas
	while($row = $resultado->fetch_array())  
	{  
		//se empieza a agregar cada reguistro al array
		$output[] = $row;  
	}  

	echo json_encode($output); 

?>  
