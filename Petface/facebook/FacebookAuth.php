<?php
	class FacebookAuth {
		
		protected $facebook;
		protected $facebookUrl = 'http://localhost/Petface/callback-facebook.php';

		public function __construct( Facebook\Facebook $facebook ) {
			$this->facebook = $facebook;
		}

		/** Funcion que genera la URL con la que el usuario se va a conectar con la API de Facebook */
		public function getHelper() {
			return $this->facebook->getRedirectLoginHelper();
		}

		/** Nos retorna la URL con la que el usuario se va a poder conectar a la aplicación */
		public function getAuthUrl() {
			return $this->getHelper()->getLoginUrl( $this->facebookUrl, array('email') );
		}

		/** Funcion para retornar una variable de sesión */
		public function isLogin() {
			return isset( $_SESSION['id_facebook'] );
		}

		/** Capturamos el usuario y los datos que se requieren */
		public function login() {
			try {
				$response = $this->facebook->get( '/me?fields=id,name,picture,gender,email', $this->getHelper()->getAccessToken() );

				// A partir de lo que obtengamos acá, podemos capturar el usuario y guardarlo en la DB
				$usuario = $response->getGraphUser();

				/**
					Por el momento, esto es solo para probar que se obtienen los datos correctamnete. 
					Ver luego cómo se registramos el usuario en nuestro sistema.
				*/
				$_SESSION["id_facebook"] = $usuario->getId();
				$_SESSION["nombre"] = $usuario->getName();
				$_SESSION["sexo"] = ( $usuario->getGender() == 'male')?'M':'F';
				$_SESSION["pathImagen"] = $usuario->getPicture()->getUrl();

				return true;
			} catch (Exception $e) {
				
			}

			return false;
		}

		/** Cerramos la sesión destruyendo las variables creadas en 'login()'. */
		public function signOut() {
			unset( $_SESSION["id_facebook"] );
		}
	}
?>