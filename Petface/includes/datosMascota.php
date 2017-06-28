<?php
  //las clases del objeto base de datos y usuario
  include_once("logica/clases/BaseDeDatos.php");
  include_once("logica/clases/Usuario.php");

  //se recupera el mail del usuario guardado en la cookie
  $mail = $_COOKIE["mail"];
  //recupera el id de la mascota pasada por el get
  $auxiliar=$_GET['nombreMascota'];
  //se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
  $database = new BaseDeDatos();

  //selecte para recuperar de la tabla mascota anidada con la tabla usuario (idUsuario en mascota con id en usuario), anidada con la tabla tipo (idTipo en mascota con id en tipo) y anidada con la tabla raza (idRaza en mascota con id en raza) recuperando las campos id, nombre, imagen, fechaNacimiento, sexo de la tabla mascota, el tipo de la tabla tipo, la raza de la tabla raza y el nombre y imagen de la tabla usuario usando la variable que tiene el id del perfil de la mascota en el where
  $queryDatosMascota= "select mascota.id as idMascota, mascota.nombre as nombreMascota, mascota.imagen as imagenMascota, mascota.idEstado as idEstadoMascota, tipo.tipo as tipo, raza.raza as raza, mascota.fechaNacimiento as fechaNacimientoMascota, mascota.edad as edad, mascota.sexo as sexoMascota, usuario.nombre as nombreUsuario, usuario.imagen as imagenUsuario, estado.estado as nombreEstado from mascota inner join usuario on mascota.idUsuario=usuario.id inner join tipo on mascota.idTipo=tipo.id inner join raza on mascota.idRaza=raza.id inner join estado on mascota.idEstado=estado.id where mascota.id='$auxiliar'";

  //resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
  $resultado =  $database->ejecutarQuery($queryDatosMascota) ;

  //se verifica si se encuentra resultados en la query para ver los datos de la mascota del perfil, por logica deberia ser un solo registro
  if ($resultado->num_rows>0) 
  {
    //empieza a recorrer cada registro
    while($row = $resultado->fetch_assoc())  
    {
      //le asigna el valor a distintas variables para usarlos a lo largo de la pagina
      $idMascota=$row["idMascota"];
      $nombreMascota=$row["nombreMascota"];
      $imagenMascota=$row["imagenMascota"];
      $idEstadoMascota=$row["idEstadoMascota"];
      $tipo=$row["tipo"];
      $raza=$row["raza"];
      $fechaNacimientoMascota=$row["fechaNacimientoMascota"];
      $edad=$row["edad"];
      $sexoMascota=$row["sexoMascota"];
      $nombreUsuario2=$row["nombreUsuario"];
      $imagenUsuario2=$row["imagenUsuario"];
      $nombreEstado=$row["nombreEstado"];

    }
  }
        
?>