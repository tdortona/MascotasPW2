 <?php  
 
 $connect = mysqli_connect("localhost", "root", "", "petfacepw2");  
 $output = array(); 
 $mail = $_COOKIE["mail"]; 
 $query = "SELECT mascota.nombre as nombre, mascota.id as id FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id where usuario.mail= '$mail' "; 
 $result = mysqli_query($connect, $query);  
 while($row = mysqli_fetch_array($result))  
 {  
      $output[] = $row;  
 }  
 echo json_encode($output);  
 ?>  