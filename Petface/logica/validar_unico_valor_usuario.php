<?php
	// las clases del objeto base de datos y usuario 
    include_once("clases/BaseDeDatos.php");
    include_once("clases/Usuario.php");

    //se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
	$database = new BaseDeDatos();

	//se recupera los valores pasado por post y se los pasa a unas variables
	$campo = $_POST["campo"];
	$valor = $_POST["valor"];

	//select para saber si hay una fila que contenga el valor del campo requerido, en este caso sera el valor del campo mail
	$query = "select * from usuario where $campo = '$valor' ";

	//resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
	$resultado =  $database->ejecutarQuery($query) ;

	//verifica si encontro algun resultado, si no hizo, significa que ya hay un usuario con ese mail y devuelve true, si no, false
	if ( $resultado->num_rows ) {
		echo 'true';
	} else {
		echo 'false';
	}
?>