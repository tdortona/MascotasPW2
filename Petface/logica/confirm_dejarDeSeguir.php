<!-- php para dejar de seguir el perfil de una mascota -->
<?php
  //se setea el id de la mascota pasada por post en una variable
	$idMascota=$_POST["idMascota"];
  //se setea el mail del usuario activo por medio de la cookie a una variable
	$mail = $_COOKIE["mail"];

  //query de conexion
	$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
    //select para recuperar el id el usuario activo usando la tabla usuario recuperando el campo id como idUsuario usando la variable mail en el where
    $sql= "SELECT id as idUsuario FROM usuario WHERE mail='$mail'";
    //query del resultado
    $result=mysqli_query($conexion,$sql);
    //verifica que hayan resultados, lo ideal es que haya un solo resultado, si no ingresa al else
    if (mysqli_num_rows($result)>0) 
    {
      //empieza a recorrer los resultados
      while($row = mysqli_fetch_assoc($result)) 
      {
        //setea la variable isUsuario con el valor del campo idUsuario
        $idUsuario=$row["idUsuario"];
      }
    }
    else
    {
    	echo 'ERROR MORTAL!!!';
    }

    //delete de la tabla seguidor usando en el where la variable idMascota y la variable idUsuario
    $sql2= "DELETE FROM seguidor WHERE idMascota='$idMascota' AND idUsuario='$idUsuario'";
    //query que efectua el resultado
		$result=mysqli_query($conexion,$sql2) or die("no se agrego la fila");
		//reguesa al perfil de la mascota pasandole por variable el id de la mascota para regresar al mismo perfil
		header("location:../perfilMascota.php"."?nombreMascota=".$idMascota);

?>