<?php
	/**
	* 
	*/
	class Usuario {
		private $id;
		private $nombre;
		private $mail;
		private $clave;
		private $sexo;

		// CONSTRUCTOR DEFAULT
		function __construct(){
			$this->id = null;
			$this->nombre = null;
			$this->mail = null;
			$this->clave = null;
			$this->sexo = null;
		}

		public function getId(){
			return $this->id;
		}

		public function setId($id){
			$this->id = $id;
		}
		
		public function getNombre(){
			return $this->nombre;
		}

		public function setNombre($nombre){
			$this->nombre = $nombre;
		}

		public function getMail(){
			return $this->mail;
		}

		public function setMail($mail){
			$this->mail = $mail;
		}

		public function getClave(){
			return $this->clave;
		}

		public function setClave($clave){
			$this->clave = $clave;
		}

		public function getSexo(){
			return $this->sexo;
		}

		public function setSexo($sexo){
			$this->sexo = $sexo;
		}
	}
?>