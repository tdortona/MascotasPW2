<?php

	/* Iniciando la sesión*/
	session_start();

	/* Cambiar según la ubicación de tu directorio*/
	require_once __DIR__ . '/facebook-login/src/Facebook/autoload.php';

	$fb = new Facebook\Facebook([
		'app_id' => '456227338083821',
		'app_secret' => '266219d785d79fbab525ce48a99d525e',
		'default_graph_version' => 'v2.4',
		]);

	$helper = $fb->getRedirectLoginHelper();

	$permissions = ['email']; // Permisos opcionales
	$loginUrl = $helper->getLoginUrl('http://localhost/Petface/facebook-login/fb-callback.php', $permissions);

	/* Link a la página de login*/
	echo '<a href="' . htmlspecialchars($loginUrl) . '">Login con Facebook!</a>';

?>