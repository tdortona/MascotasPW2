<?php 
    include_once("clases/BaseDeDatos.php");
    include_once("clases/Usuario.php");

	$mail=$_POST["mail"];
	$password=$_POST["password"];
    $database = new BaseDeDatos();
	$estado=0;

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

	

	$query= "SELECT * FROM usuario";

	$resultado =  $database->ejecutarQuery($query) ;
	

	while($fila = $resultado->fetch_assoc()) 
    {
        if ($fila['mail']==$mail && $fila['password']==$password)
        {
        	$estado=1;
        	setcookie("mail",$mail,time()+1728000,"/");
        	header("location:../home.php");
        	break;
        	
        }
        else
        {
        	$estado=0;
        }    
        
    }

    if ($estado==0)
    {
    	session_start();
    	$_SESSION["noIngreso"]=1;
    	header("location:../index.php");
    }
?>