<?php
	require_once("facebook/init.php");

	if ( $fbAuth->login() ) {
		header("location:en-blanco-para-verificar-success-api-facebook.php");
	} else {
		die("ERROR al iniciar sesión con Facebook.");
	}
?>