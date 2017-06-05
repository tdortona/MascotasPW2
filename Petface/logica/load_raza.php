<!-- php para cargar todas las razas para usarlo en un script de angular -->
<?php 
	//query de conexion
	$connect = mysqli_connect("localhost", "root", "", "petfacepw2");
	//se crea una array  
	$output = array();  
	//codigo relacionado con angular, pendiente de entendimiento
	$data = json_decode(file_get_contents("php://input"));  
	//select que devulelve todos los campos de la tabla razas donde por angular el where coincide idTipo con el tipo seleccionado en el ese momento ordenamos con el campo raza ordemandos de manera acendente
	$query = "SELECT * FROM raza WHERE idTipo='".$data->id."' ORDER BY raza ASC";  
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
