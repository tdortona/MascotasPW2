
<?php
	//las clases del objeto base de datos y usuario
  include_once("clases/BaseDeDatos.php");
  include_once("clases/Usuario.php");


	$mensajeId = $_POST["mensajeId"];

	//se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
	$database = new BaseDeDatos();
	//se recupera el mail del usuario guardado en la cookie
	$mail = $_COOKIE["mail"];


	$queryIdUsuario = "SELECT * FROM usuario WHERE mail = '$mail'";
	$resultado = $database->ejecutarQuery($queryIdUsuario) ;

	while($row = $resultado->fetch_assoc())  
		{

			$usuarioId = $row["id"];

		}
	$queryBorrarMensaje = "DELETE FROM mensaje WHERE idUsuario= '$usuarioId' and id = '$mensajeId'";
	$database->ejecutarQuery($queryBorrarMensaje) ;

	header("location:../mensaje.php");
?>