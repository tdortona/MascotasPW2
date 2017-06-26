<?php

	session_start();
	require_once("google/init.php");

	if ( $googleAuth->checkRedirectCode() ) {
		$_SESSION["id_google"] = print_r( $googleAuth->getPayload() );
		header("location:en-blanco-para-verificar-success-api-google.php");
	} else {
		die("ERROR al iniciar sesión con Google.");
	}
?>