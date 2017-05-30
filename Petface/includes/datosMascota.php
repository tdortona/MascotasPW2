<?php
        $mail = $_COOKIE["mail"];
        $auxiliar=$_GET['nombreMascota'];

          
          $conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
          $sql= "SELECT mascota.id as idMascota, mascota.nombre as nombreMascota, mascota.imagen as imagenMascota, tipo.tipo as tipo, raza.raza as raza, mascota.fechaNacimiento as fechaNacimientoMascota, mascota.sexo as sexoMascota, usuario.nombre as nombreUsuario, usuario.imagen as imagenUsuario FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id INNER JOIN tipo ON mascota.idTipo=tipo.id INNER JOIN raza ON mascota.idRaza=raza.id where mascota.id='$auxiliar'";
          $result = mysqli_query($conexion,$sql);
          if (mysqli_num_rows($result)>0) 
          {
            while($row = mysqli_fetch_assoc($result)) 
            {
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