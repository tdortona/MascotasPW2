<!-- include que verifica si no esta la cookie de mail seteada, si lo esta redirige de inmediato al index impidiendo entrar a esta pagina -->
<?php 
	if(!isset($_COOKIE["mail"]))
	{
		header("location:index.php");
	}
?>