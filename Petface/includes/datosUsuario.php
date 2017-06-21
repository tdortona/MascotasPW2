<?php
  //las clases del objeto base de datos y usuario
  include_once("logica/clases/BaseDeDatos.php");
  include_once("logica/clases/Usuario.php");

  //se recupera el mail del usuario guardado en la cookie
  $mail = $_COOKIE["mail"]; 
  //se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
  $database = new BaseDeDatos();  

  //select para recuperar de la tabla usaurio los campos nombre, imagenUsuario, fechaNacimiento, sexo usando el valor de la variable mail en el where
  $queryDatosUsuario= "select usuario.nombre as nombreUsuario, usuario.imagen as imagenUsuario,  usuario.fechaNacimiento as fechaNacimientoUsuario, usuario.sexo as sexoUsuario from usuario where usuario.mail= '$mail' ";

  //resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
  $resultado =  $database->ejecutarQuery($queryDatosUsuario) ;

  //se verifica si se encuentra resultados en la query para ver los datos de la mascota del perfil, por logica deberia ser un solo registro
  if ($resultado->num_rows>0) 
  {
    //empieza a recorrer cada registro
    while($fila = $resultado->fetch_assoc())  
    {
      //le asigna el valor a distintas variables para usarlos a lo largo de la pagina
      $nombreUsuario=$fila["nombreUsuario"];
      $imagenUsuario=$fila["imagenUsuario"];
      $fechaNacimientoUsuario=$fila["fechaNacimientoUsuario"];
      $sexoUsuario=$fila["sexoUsuario"];
    }
  }
        
?>