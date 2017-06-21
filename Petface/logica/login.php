<!-- php para verificar si el mail y  -->
<?php 
    // las clases del objeto base de datos y usuario 
    include_once("clases/BaseDeDatos.php");
    include_once("clases/Usuario.php");

    //setea todas las variables con los valores que se le paso por el post
	$mail=$_POST["mail"];
	$password=md5($_POST["password"]);

    //se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
    $database = new BaseDeDatos();

    //el estado sirve para ir verificando que todo esta yendo bien, si el estado cambia a 0 significa que algo salio mal y asi se evita que prosiga con los demas pasos que verifican el estado al principo de la accion con un if. De arranque es 0
	$estado=0;

    //provicional: si el mail o la contraseña estan vacias devuelve al index.php
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

    //select que devuelve todos los registros de la tabla usuario
	$query= "SELECT * FROM usuario";

    //resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
	$resultado =  $database->ejecutarQuery($query) ;
	
    //empieza a recorrer los registros resultados 
	while($fila = $resultado->fetch_assoc()) 
    {
        //verifico si el mail y el password del registro coinciden en los de las variables, si son iguales entro al if
        if ($fila['mail']==$mail && $fila['password']==$password)
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