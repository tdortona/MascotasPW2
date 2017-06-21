<?php  	
	// las clases del objeto base de datos y usuario 
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");

	//se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
	$database = new BaseDeDatos();

	//se crea una array
	$output = array(); 

	//recupera el id del tipo elegido en el otro select
	$data = json_decode(file_get_contents("php://input")); 

	//select que devulelve todos los campos de la tabla razas donde por angular el where coincide idTipo con el tipo seleccionado en el ese momento ordenamos con el campo raza ordemandos de manera acendente
	$queryRazas = "select * from raza where idTipo='".$data->id."' order by raza asc";  

	//resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
	$resultado = $database->ejecutarQuery($queryRazas) ;

	//empieza a recorrer las filas
	while($row = $resultado->fetch_array())  
	{  
		//se empieza a agregar cada reguistro al array
		$output[] = $row;  
	}  

	echo json_encode($output);  

?>  
