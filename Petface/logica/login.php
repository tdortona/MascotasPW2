<!-- php para verificar si el mail y  -->
<?php 
    //setea todas las variables con los valores que se le paso por el post
	$mail=$_POST["mail"];
	$password=$_POST["password"];
    //el estado sirve para ir verificando que todo esta yendo bien, si el estado cambia a 0 significa que algo salio mal y asi se evita que prosiga con los demas pasos que verifican el estado al principo de la accion con un if. De arranque es 0
	$estado=0;

    //provicional, si el mail o la contraseña estan vacias devuelve al index.php
	if(isset($_POST["mail"]) or $_POST["mail"]!="")
	{
		if(isset($_POST["password"]) or $_POST["password"]!="")
		{

		}
		else
		{
			header("location:../index.php");
		}
	} 
	else
	{
		header("location:../index.php");
	}

    //query de conexion
	$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
    //select que devuelve todos los registros de la tabla usuario
	$sql= "SELECT * FROM usuario";
    //query del resultado
	$result = mysqli_query($conexion,$sql);

    //empieza a recorrer los registros resultados 
	while($row = mysqli_fetch_assoc($result)) 
    {
        //verifico si el mail y el password del registro coinciden en los de las variables, si son iguales entro al if
        if ($row['mail']==$mail && $row['password']==$password)
        {   
            //pongo la variable estado en 1, creo la cookie con el mail del usuario, voy al home.php y el break para salir del loop 
        	$estado=1;
        	setcookie("mail",$mail,time()+1728000,"/");
        	header("location:../home.php");
        	break;
        	
        }
        //si no entro al if voy al else
        else
        {
            //pongo el estado en 0
        	$estado=0;

        }    
        
    }

    //si el estado esta en 0 como corresponderia en este punto entra en el if
    if ($estado==0)
    {
        //inicia sesion
    	session_start();
        //setea la variable de sesion "noIngreso" en 1
    	$_SESSION["noIngreso"]=1;
        //vuelve al index.php
    	header("location:../index.php");
    }
?>