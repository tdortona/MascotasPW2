<?php
	class GoogleAuth {
		
		protected $client;

		/**
		*	Creamos el objeto recibiendo como parámetro un objeto del tipo 'Google_Client' (Ya descargado anteriormente con Composer)
		*	Y por defecto lo inicializamos nulo.
		*/
		public function __construct( Google_Client $googleClient = null ) {
			$this->client = $googleClient;

			if ( $this->client ) {
				$this->client->setClientId('165400743735-ddmfebjudq1vga6f25mqfnb9oad58j77.apps.googleusercontent.com');
				$this->client->setClientSecret('K1Za18df7d-kNyN2wp_xyCWj');
				$this->client->setRedirectUri('http://localhost/Petface/callback-google.php');
				$this->client->setScopes('email');
			}
		}

		public function isLogin() {
			return isset( $_SESSION["access_token"] );
		}

		/** Nos retorna la URL con la que el usuario se va a poder conectar a la aplicación */
		public function getAuthUrl() {
			return $this->client->createAuthUrl();
		}

		/** Ocultamos el codigo para que no se vea en la URL */
		public function checkRedirectCode() {
			if ( isset( $_GET["code"] ) ) {
				$this->client->authenticate( $_GET["code"] );
				$this->setToken( $this->client->getAccessToken() ); // Seteamos el Token que nos da la API

				return true;
			}
			/** En caso de que no exista el código, retornamos 'false' */
			return false;
		}

		public function setToken( $token ) {
			$_SESSION["access_token"] = $token;
			$this->client->setAccessToken( $token );
		}

		/** Cerramos la sesión destruyendo las variables de sesión creadas. */
		public function logout() {
			unset( $_SESSION["access_token"] );
		}

		/** Obtenemos todos los datos del usuario */
		public function getPayload() {
			if ( $this->client->getAccessToken() ) {
				$payload = $this->client->verifyIdToken()->getAttributes();
				//$payload = $this->client->verifyIdToken();
				return $payload;
			}
		}
	}
?>