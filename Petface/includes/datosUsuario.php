<!-- php que devuelve todos los datos del usaurio activo -->
<?php
  //recuperamos el valor de la cookie y se la asignamos a la variable mail
  $mail = $_COOKIE["mail"];
  //query de conexion
  $conexion2 = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
  //select para recuperar de la tabla usaurio los campos nombre, imagenUsuario, fechaNacimiento, sexo usando el valor de la variable mail en el where
  $sql2= "SELECT usuario.nombre as nombreUsuario, usuario.imagen as imagenUsuario,  usuario.fechaNacimiento as fechaNacimientoUsuario, usuario.sexo as sexoUsuario FROM usuario where usuario.mail= '$mail' ";
  //query del resultado
  $result2 = mysqli_query($conexion2,$sql2);
  //se verifica si se encontraron registros
  if (mysqli_num_rows($result2)>0) 
  {
    //se empieza a recorrer los registros resultados
    while($row2 = mysqli_fetch_assoc($result2)) 
    {
      //se asigna los valores de los campos a las variables para usar en la pagina
      $nombreUsuario=$row2["nombreUsuario"];
      $imagenUsuario=$row2["imagenUsuario"];
      $fechaNacimientoUsuario=$row2["fechaNacimientoUsuario"];
      $sexoUsuario=$row2["sexoUsuario"];
    }
  }

?>