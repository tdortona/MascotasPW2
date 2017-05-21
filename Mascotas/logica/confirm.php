

<?php

	$usuario=$_POST["usuario"];
	$password=$_POST["password"];
	$nombre=$_POST["nombre"];
	$mail=$_POST["mail"];
	$estado=0;

	if(isset($_POST["usuario"]) or $_POST["usuario"]!="")
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
	
	$conexion = mysqli_connect("localhost", "root", "", "PetFace") or die ("No se puede conectar con el servidor");

	$sql= "SELECT * FROM cuentas";

	$result = mysqli_query($conexion,$sql);
	$result2 = mysqli_query($conexion,$sql);

	while($row = mysqli_fetch_assoc($result)) 
    {
        if ($row["Usuario"]!=$usuario)
        {
        	$estado=1;
        	
        }
        else
        {
        	$estado=0;
        	session_start();

        	$_SESSION["error"]=$usuario;
        	$_SESSION["errorTipo"]="usuario";
        	header("location:../fallo.php");
        	break;
        }    
        
    }

    if ($estado==1)
    {
    	while($row = mysqli_fetch_assoc($result2)) 
	    {
		    if ($row["Email"]!=$mail)
		    {
		    	$estado=1;
		    }
		    else
		    {
		        $estado=0;
		        session_start();

		        $_SESSION["error"]=$mail;
		        $_SESSION["errorTipo"]="E-mail";
		        header("location:../fallo.php");
		        break;
		    }
		}
    }
	    
	if ($estado==1)
	{
		$sql= "INSERT INTO cuentas VALUES ('','$usuario','$password','$nombre','$mail')";
		$result=mysqli_query($conexion,$sql) or die("no se agrego la fila");
		session_start();
		$_SESSION["usuario"]=$usuario;
		$_SESSION["mail"]=$mail;
		header("location:../correcto.php");
	}
	
	/*$result3 = mysqli_query($conexion,$sql);

	if (mysqli_num_rows($result3)>0) 
	{
		echo "entro aca <br>";
		while($row2 = mysqli_fetch_assoc($result3)) 
	    {
			echo "id: " . $row2["Id"]. " - Name: " . $row2["Usuario"]. " " . "<br> \n";
		}
	} 
	else 
	{
    	echo "0 results";
	}*/
	
	$conexion->close();

?>

<?php echo "<a href=\"../registro.php\">volver</a>" ?>