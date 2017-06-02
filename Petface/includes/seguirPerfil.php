<?php

$sqlChequearSiSigue= "SELECT * FROM seguidor INNER JOIN mascota ON seguidor.idMascota=mascota.id INNER JOIN usuario ON seguidor.idUsuario=usuario.id WHERE usuario.mail='$mail' and mascota.id='$idMascota'";
$resultVerificarSiSiguePerfil=mysqli_query($conexion,$sqlChequearSiSigue);
if (mysqli_num_rows($resultVerificarSiSiguePerfil)>0) 
    {
      echo'
<form action="logica\confirm_dejarDeSeguir.php" method="POST">
	<input type="hidden" name="idMascota" value="'.$idMascota.'">
	<input type="submit" class="btn btn-danger" value="Dejar de seguir mascota"></input>
</form>	
<br><br>';
    }
    else
    {
    	echo'
<form action="logica\confirm_seguir.php" method="POST">
	<input type="hidden" name="idMascota" value="'.$idMascota.'">
	<input type="submit" class="btn btn-primary" value="Seguir mascota"></input>
</form>	
<br><br>';
    }



?>