<?php
  //las clases del objeto base de datos y usuario
  include_once("clases/BaseDeDatos.php");
  include_once("clases/Usuario.php");

  //se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
  $database = new BaseDeDatos();

  //setea todas las variables con los valores que se le paso por el post
  $idMascota=$_POST["idMascota"];
  $mail = $_COOKIE["mail"];

  //select para saber el id del usaurio actual rescatando el id de la tabla usuario usando en el where el mail del usuario activo
  $queryIdUsuario= "select id as idUsuario from usuario where mail='$mail'";
  //resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
  $resultado=$database->ejecutarQuery($queryIdUsuario) ;

  //verifica que haya una fila que coincida con el mail del usuario activo, por logica tiene que traer una sola, ya que el mail es unico entre los usuarios 
  if ($resultado->num_rows>0) 
  {
    //si encuentra filas, las empieza a recorrer
    while($fila = $resultado->fetch_assoc()) 
    {
      //le asigna el id del usaurio activo a la variable
      $idUsuario=$fila["idUsuario"];
    }
  }
  //si llega al else algo esta mal, ya que el usuario activo deberia estar registrado
  else
  {
    echo 'ERROR MORTAL!!!';
  }

  //query para insertar el seguimiento de ese usuario a ese perfil de mascota
  $querySeguir= "insert into seguidor values ('$idUsuario','$idMascota')";

  //se ejecuta la query por medio del metodo del objeto
  $database->ejecutarQuery($querySeguir) ;

  //redirige al perfil de la mascota  
  header("location:../perfilMascota.php"."?nombreMascota=".$idMascota);

?>