<?php
	$mail = $_COOKIE["email"];
	echo $mail;
	setcookie("email",$mail,time()+1728000,"/");
?>
<form action="logica\logout.php" method="POST">
	<input type="submit" class="btn btn-primary btn-block" value="salir"></input>
</form>