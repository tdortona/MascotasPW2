 <?php  
 
 $connect = mysqli_connect("localhost", "root", "", "petfacepw2");  
 $output = array();  
 $query = "SELECT * FROM tipo ORDER BY tipo ASC";  
 $result = mysqli_query($connect, $query);  
 while($row = mysqli_fetch_array($result))  
 {  
      $output[] = $row;  
 }  
 echo json_encode($output);  
 ?>  