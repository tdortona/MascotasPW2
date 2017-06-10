<?php

  include_once("clases/BaseDeDatos.php");
  include_once("clases/Usuario.php");

	$idMascota=$_POST["idMascota"];
	$mail = $_COOKIE["mail"];

  $database = new BaseDeDatos();

	
    $queryIdUsuario= "select id as idUsuario from usuario where mail='$mail'";
    $resultado=$database->ejecutarQuery($queryIdUsuario) ;

    if ($resultado->num_rows>0) 
    {
      while($fila = $resultado->fetch_assoc()) 
      {
        $idUsuario=$fila["idUsuario"];
      }
    }
    else
    {
    	echo 'ERROR MORTAL!!!';
    }

    $queryDejarSeguir= "delete from seguidor where idMascota='$idMascota' and idUsuario='$idUsuario'";

		$resultado2=$database->ejecutarQuery($queryDejarSeguir) ;
		
		header("location:../perfilMascota.php"."?nombreMascota=".$idMascota);

?>