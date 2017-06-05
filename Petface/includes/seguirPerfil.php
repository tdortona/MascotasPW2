<!-- verifica si el usaurio sigue o no a la mascota y muestra los botones correspondientes -->
<?php
//selecte para verificar si el usaurio sigue a la mascota usando la tabla seguidor anidada con la tabla mascota (idMascota de seguidores con id de mascota) y anidada con la tabla usuario (idUsuario de seguidor con id de usuario) usando en el where el mail del usuario definido en una variable en el include datosUsuario y el id de la mascota definido en una variable en el include datosMascota.php
$sqlChequearSiSigue= "SELECT * FROM seguidor INNER JOIN mascota ON seguidor.idMascota=mascota.id INNER JOIN usuario ON seguidor.idUsuario=usuario.id WHERE usuario.mail='$mail' and mascota.id='$idMascota'";
//query resultado
$resultVerificarSiSiguePerfil=mysqli_query($conexion,$sqlChequearSiSigue);
//busca si encuentra un resultado, si lo encuentra quiere decir que seguia a la mascota, entra en el if, si no, quiere decir que no la seguia, entra en el else
if (mysqli_num_rows($resultVerificarSiSiguePerfil)>0) 
    {
        //crea un formulario con metodo post donde hay un input oculto con el valor del id de la mascota y lo envia a la pagina confirm_dejarDeSeguir.php 
        echo'
        <form action="logica\confirm_dejarDeSeguir.php" method="POST">
        	<input type="hidden" name="idMascota" value="'.$idMascota.'">
        	<input type="submit" class="btn btn-danger" value="Dejar de seguir mascota"></input>
        </form>	
        <br><br>';
    }
    else
    {
        //crea un formulario con metodo post donde hay un input oculto con el valor del id de la mascota y lo envia a la pagina confirm_seguir.php
        echo'
        <form action="logica\confirm_seguir.php" method="POST">
        	<input type="hidden" name="idMascota" value="'.$idMascota.'">
        	<input type="submit" class="btn btn-primary" value="Seguir mascota"></input>
        </form>	
        <br><br>';
    }



?>