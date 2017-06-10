<?php
  include_once("logica/clases/BaseDeDatos.php");
  include_once("logica/clases/Usuario.php");

 

  $mail = $_COOKIE["mail"];
  $database = new BaseDeDatos();
    
  
  $queryDatosUsuario= "select usuario.nombre as nombreUsuario, usuario.imagen as imagenUsuario,  usuario.fechaNacimiento as fechaNacimientoUsuario, usuario.sexo as sexoUsuario from usuario where usuario.mail= '$mail' ";

  $resultado =  $database->ejecutarQuery($queryDatosUsuario) ;

  if ($resultado->num_rows>0) 
  {
    while($fila = $resultado->fetch_assoc())  
    {
      $nombreUsuario=$fila["nombreUsuario"];
      $imagenUsuario=$fila["imagenUsuario"];
      $fechaNacimientoUsuario=$fila["fechaNacimientoUsuario"];
      $sexoUsuario=$fila["sexoUsuario"];
    }
  }
        
?>