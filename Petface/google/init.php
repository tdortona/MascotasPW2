<?php
	require_once("vendor/autoload.php");
	require_once("google/GoogleAuth.php");

	$googleClient = new Google_Client();

	$googleAuth = new GoogleAuth( $googleClient );
?>