<?php  
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");

	$database = new BaseDeDatos();

	$output = array();  

	$queryTipos = "select * from tipo order by tipo asc";  

	$resultado = $database->ejecutarQuery($queryTipos) ;

	while($row = $resultado->fetch_array())  
	{  
	  $output[] = $row;  
	}  

	echo json_encode($output);  
?>  
