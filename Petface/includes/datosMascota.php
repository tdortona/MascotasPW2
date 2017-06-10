<?php
  include_once("logica/clases/BaseDeDatos.php");
  include_once("logica/clases/Usuario.php");

  $mail = $_COOKIE["mail"];
  $auxiliar=$_GET['nombreMascota'];
  $database = new BaseDeDatos();

  $queryDatosMascota= "select mascota.id as idMascota, mascota.nombre as nombreMascota, mascota.imagen as imagenMascota, mascota.idEstado as idEstadoMascota, tipo.tipo as tipo, raza.raza as raza, mascota.fechaNacimiento as fechaNacimientoMascota, mascota.sexo as sexoMascota, usuario.nombre as nombreUsuario, usuario.imagen as imagenUsuario from mascota inner join usuario on mascota.idUsuario=usuario.id inner join tipo on mascota.idTipo=tipo.id inner join raza on mascota.idRaza=raza.id where mascota.id='$auxiliar'";

  $resultado =  $database->ejecutarQuery($queryDatosMascota) ;

  if ($resultado->num_rows>0) 
  {
    while($fila = $resultado->fetch_assoc())  
    {
      $idMascota=$fila["idMascota"];
      $nombreMascota=$fila["nombreMascota"];
      $imagenMascota=$fila["imagenMascota"];
      $idEstadoMascota=$fila["idEstadoMascota"];
      $tipo=$fila["tipo"];
      $raza=$fila["raza"];
      $fechaNacimientoMascota=$fila["fechaNacimientoMascota"];
      $sexoMascota=$fila["sexoMascota"];
      $nombreUsuario2=$fila["nombreUsuario"];
      $imagenUsuario2=$fila["imagenUsuario"];

    }
  }
        
?>