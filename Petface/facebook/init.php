<?php
	session_start();
	require_once("vendor/autoload.php");
	require_once("facebook/FacebookAuth.php");

	$facebook = new Facebook\Facebook([
		'app_id' => '277102949420299',
		'app_secret' => 'e6ae419acf0a7139ed38d3d4aa3df695',
		'default_graph_version' => 'v2.9',
	]);

	$fbAuth = new FacebookAuth( $facebook );
?>