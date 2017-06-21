<!-- php para eliminar la cookie que mantiene la sesion del usuario activa -->
<?php
	//se elinima la cookie
	setcookie("mail","",time()-100,"/");
	header("location:../index.php"); 
?>