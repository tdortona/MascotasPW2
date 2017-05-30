<?php
        $mail = $_COOKIE["mail"];
          
        $conexion2 = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
        $sql2= "SELECT usuario.nombre as nombreUsuario, usuario.imagen as imagenUsuario,  usuario.fechaNacimiento as fechaNacimientoUsuario, usuario.sexo as sexoUsuario FROM usuario where usuario.mail= '$mail' ";
        $result2 = mysqli_query($conexion2,$sql2);
        if (mysqli_num_rows($result2)>0) 
        {
          while($row2 = mysqli_fetch_assoc($result2)) 
          {
            $nombreUsuario=$row2["nombreUsuario"];
            $imagenUsuario=$row2["imagenUsuario"];
            $fechaNacimientoUsuario=$row2["fechaNacimientoUsuario"];
            $sexoUsuario=$row2["sexoUsuario"];

          }
        }
        
?>