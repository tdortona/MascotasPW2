<?php
	session_start();
	echo $_SESSION["id_facebook"]."<br>",
		$_SESSION["nombre"]."<br>",
		$_SESSION["sexo"]."<br>",
		"<img src='".$_SESSION['pathImagen']."'>";
?>