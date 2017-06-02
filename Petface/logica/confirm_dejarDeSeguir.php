<?php

	$idMascota=$_POST["idMascota"];
	$mail = $_COOKIE["mail"];

	$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
    $sql= "SELECT id as idUsuario FROM usuario WHERE mail='$mail'";
    $result=mysqli_query($conexion,$sql);
    if (mysqli_num_rows($result)>0) 
    {
      while($row = mysqli_fetch_assoc($result)) 
      {
        $idUsuario=$row["idUsuario"];
      }
    }
    else
    {
    	echo 'ERROR MORTAL!!!';
    }

    $sql2= "DELETE FROM seguidor WHERE idMascota='$idMascota' AND idUsuario='$idUsuario'";
		$result=mysqli_query($conexion,$sql2) or die("no se agrego la fila");
		
		header("location:../perfilMascota.php"."?nombreMascota=".$idMascota);

?>