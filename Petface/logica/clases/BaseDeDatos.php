<?php
	class BaseDeDatos {

		private $servidor;
		private $usuario;
		private $clave;
		private $nombreDelEsquema;
		private $conexion;

		function __construct() {
			$this->servidor = "localhost";
			$this->usuario = "root";
			$this->clave = "";
			$this->nombreDelEsquema = "petfacepw2";
			$this->conexion = new mysqli($this->servidor, $this->usuario, $this->clave, $this->nombreDelEsquema);
		}

		public function verEstadoDeConexion() {
			if ( $this->conexion )
				echo "Conexion exitosa.";
			else
				echo "Error en la conexion.";
		}

		public function ejecutarQuery($sql) {
			$resultado = mysqli_query($this->conexion, $sql);
			return $resultado;
		}
	}
?>