<!-- php que devuelve todos los datos del perfil de la mascota -->
<?php
  //recuperamos el valor de la cookie y se la asignamos a la variable mail
  $mail = $_COOKIE["mail"];
  //recuperamos el id de la mascota pasado en la url y se lo asignamos a una variable
  $auxiliar=$_GET['nombreMascota'];
  //query de conexion
  $conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
  //selecte para recuperar de la tabla mascota anidada con la tabla usuario (idUsuario en mascota con id en usuario), anidada con la tabla tipo (idTipo en mascota con id en tipo) y anidada con la tabla raza (idRaza en mascota con id en raza) recuperando las campos id, nombre, imagen, fechaNacimiento, sexo de la tabla mascota, el tipo de la tabla tipo, la raza de la tabla raza y el nombre y imagen de la tabla usuario usando la variable que tiene el id del perfil de la mascota en el where
  $sql= "SELECT mascota.id as idMascota, mascota.nombre as nombreMascota, mascota.imagen as imagenMascota, tipo.tipo as tipo, raza.raza as raza, mascota.fechaNacimiento as fechaNacimientoMascota, mascota.sexo as sexoMascota, usuario.nombre as nombreUsuario, usuario.imagen as imagenUsuario FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id INNER JOIN tipo ON mascota.idTipo=tipo.id INNER JOIN raza ON mascota.idRaza=raza.id where mascota.id='$auxiliar'";
  //query resultado
  $result = mysqli_query($conexion,$sql);
  //se verifica si se encontraron registros
  if (mysqli_num_rows($result)>0) 
  {
    //se empieza a recorrer los registros resultados
    while($row = mysqli_fetch_assoc($result)) 
    {
      //se asigna los valores de los campos a las variables para usar en la pagina
      $idMascota=$row["idMascota"];
      $nombreMascota=$row["nombreMascota"];
      $imagenMascota=$row["imagenMascota"];
      $tipo=$row["tipo"];
      $raza=$row["raza"];
      $fechaNacimientoMascota=$row["fechaNacimientoMascota"];
      $sexoMascota=$row["sexoMascota"];
      $nombreUsuario2=$row["nombreUsuario"];
      $imagenUsuario2=$row["imagenUsuario"];

    }
  }
        
?>