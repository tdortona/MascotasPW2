 <?php  	
 	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");

	 $database = new BaseDeDatos();

	 $output = array(); 

	 $mail = $_COOKIE["mail"]; 

	 $queryMascotasDelUsuario = "select mascota.nombre as nombre, mascota.id as id from mascota inner join usuario ON mascota.idUsuario=usuario.id where usuario.mail= '$mail' "; 

	 $resultado = $database->ejecutarQuery($queryMascotasDelUsuario) ;

	 while($row = $resultado->fetch_array())  
	 {  
	      $output[] = $row;  
	 }  
	 echo json_encode($output);  
 ?>  