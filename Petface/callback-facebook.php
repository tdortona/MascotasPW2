<?php
	require_once("facebook/init.php");
	require_once("logica/clases/BaseDeDatos.php");

	if ( $fbAuth->login() ) {

		$database = new BaseDeDatos();
		
		// Verificamos que se haya seteado al menos una de las variables de sesión
		if ( isset( $_SESSION["id_facebook"] ) ) {
			
			$mail = $_SESSION["mail"];
			$idFacebook = $_SESSION["id_facebook"]; // Usaremos $idFacebook para setearlo como clave del usuario
			$nombre = $_SESSION["nombre"];
			$fechaNacimiento = date( 'Y-m-d', strtotime($_SESSION["fechaNacimiento"]) ); // Parseamos la fecha a tipo 'Date'
			$sexo = $_SESSION["sexo"];
			$imagen = $_SESSION["pathImagen"];
			
			/** Consultamos si hay un usuario registrado con el mail que nos devolvió la API de Facebook */
			$consultaUsuario = "select * from usuario where mail = '$mail'";
			$resultadoConsultaUsuario = mysqli_fetch_array( $database->ejecutarQuery( $consultaUsuario ) );

			/**
			*	En caso de que exista un usuario con ese mail, lo enviamos al home.
			*	Y en caso de que no exista, lo insertamos en la DB.
			*/
			if ( $resultadoConsultaUsuario ) {
				setcookie("mail",$mail,time()+1728000,"/");
			} else {
				$fechaRegistro=date('Y-m-d');
				$insert_query= "insert into usuario values ('', '$mail', '$idFacebook', '$nombre', '', '$fechaNacimiento', '$sexo', '$imagen', '', '$fechaRegistro')";
				$database->ejecutarQuery($insert_query);
				
				setcookie("mail",$mail,time()+1728000,"/");
			}
		}

    	header("location:home.php");
    	session_destroy();
	} else {
		
		die("ERROR al iniciar sesión con Facebook.");
	
	}
?>