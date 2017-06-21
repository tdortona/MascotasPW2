<?php
    //las clases del objeto base de datos y usuario
    include_once("logica/clases/BaseDeDatos.php");
    include_once("logica/clases/Usuario.php");

    //se recupera el mail del usuario guardado en la cookie
    $mail = $_COOKIE["mail"]; 
    //se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
    $database = new BaseDeDatos();  

    //selecte para verificar si el usaurio sigue a la mascota usando la tabla seguidor anidada con la tabla mascota (idMascota de seguidores con id de mascota) y anidada con la tabla usuario (idUsuario de seguidor con id de usuario) usando en el where el mail del usuario definido en una variable en el include datosUsuario y el id de la mascota definido en una variable en el include datosMascota.php
    $queryChequearSiSigue= "SELECT * FROM seguidor INNER JOIN mascota ON seguidor.idMascota=mascota.id INNER JOIN usuario ON seguidor.idUsuario=usuario.id WHERE usuario.mail='$mail' and mascota.id='$idMascota'";

    //resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
    $resultado =  $database->ejecutarQuery($queryChequearSiSigue) ;

    //se verifica si se encuentra resultados en la query para ver si el usuario activo ya seguia o no a la mascota
    if ($resultado->num_rows>0) 
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