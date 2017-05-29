
 <?php  
 $connect = mysqli_connect("localhost", "root", "", "petfacepw2");  
 $output = array();  
 $data = json_decode(file_get_contents("php://input"));  
 $query = "SELECT * FROM raza WHERE idTipo='".$data->id."' ORDER BY raza ASC";  
 $result = mysqli_query($connect, $query);  
 while($row = mysqli_fetch_array($result))  
 {  
      $output[] = $row;  
 }  
 echo json_encode($output);  
 ?>  
