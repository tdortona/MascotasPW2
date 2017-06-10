<?php
    include_once("logica/clases/BaseDeDatos.php");
    include_once("logica/clases/Usuario.php");

    $mail = $_COOKIE["mail"];
    $database = new BaseDeDatos();

    $queryChequearSiSigue= "SELECT * FROM seguidor INNER JOIN mascota ON seguidor.idMascota=mascota.id INNER JOIN usuario ON seguidor.idUsuario=usuario.id WHERE usuario.mail='$mail' and mascota.id='$idMascota'";
    $resultado =  $database->ejecutarQuery($queryChequearSiSigue) ;

     if ($resultado->num_rows>0) 
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