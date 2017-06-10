
<?php  
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");

	$database = new BaseDeDatos();

	$output = array();  

	$data = json_decode(file_get_contents("php://input")); 

	$queryRazas = "select * from raza where idTipo='".$data->id."' order by raza asc";  

	$resultado = $database->ejecutarQuery($queryRazas) ;

	while($row = $resultado->fetch_array())  
	{  
	  $output[] = $row;  
	}  

	echo json_encode($output);  
?>  
