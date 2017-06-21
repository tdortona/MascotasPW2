<!-- include que verifica si esta la cookie de mail seteada, si lo esta redirige de inmediato al home impidiendo entrar a esta pagina -->
<?php 
	if(isset($_COOKIE["mail"]))
	{
		header("location:home.php");
	}
?>