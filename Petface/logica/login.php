<?php 
	$mail=$_POST["mail"];
	$password=md5($_POST["password"]);
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

	$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");

	$sql= "SELECT * FROM usuario";

	$result = mysqli_query($conexion,$sql);
	$result2 = mysqli_query($conexion,$sql);

	while($row = mysqli_fetch_assoc($result)) 
    {
        if ($row['mail']==$mail && $row['password']==md5($password))
        {
        	$estado=1;
        	setcookie("mail",$mail,time()+1728000,"/");
        	header("location:../home.php");
        	break;
        	
        }
        else
        {
        	$estado=0;

            /*echo $row['mail'].'<br>';
            echo $row['password'].'<br>';
            echo $mail.'<br>';
            echo $password.'<br>';*/

        	/*session_start();

        	$_SESSION["error"]=$usuario;
        	$_SESSION["errorTipo"]="usuario";
        	header("location:fallo.php");
        	break;*/
        }    
        
    }




    if ($estado==0)
    {
    	session_start();
    	$_SESSION["noIngreso"]=1;
    	header("location:../index.php");
    }
?>