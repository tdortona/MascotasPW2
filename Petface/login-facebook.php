<?php

	/* Iniciando la sesión*/
	session_start();

	/* Cambiar según la ubicación de tu directorio*/
	require_once __DIR__ . '/facebook/src/Facebook/autoload.php';

	$fb = new Facebook\Facebook([
		'app_id' => 'Su App ID',
		'app_secret' => 'Su App Secret',
		'default_graph_version' => 'v2.4',
		]);

	$helper = $fb->getRedirectLoginHelper();

	$permissions = ['email']; // Permisos opcionales
	$loginUrl = $helper->getLoginUrl('http://localhost/webs/ejemplos/facebook/fb-callback.php', $permissions);

	/* Link a la página de login*/
	echo '<a href="' . htmlspecialchars($loginUrl) . '">Login con Facebook!</a>';

?>