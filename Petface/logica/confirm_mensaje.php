<<?php
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");

	$mensaje=$_POST["Mensaje"];
	$idUsuario=$_POST["idUsuario"];
	$mailUsuario=$_POST["mailUsuario"];
	$fechaMensaje=date('Y-m-d H:i:s');
	$database = new BaseDeDatos();

	if (isset($_COOKIE["mail"]))
	{
		$mail = $_COOKIE["mail"];
		$queryIdUsuario="select id from usuario where mail='$mail'";
		$resultado = $database->ejecutarQuery($queryIdUsuario) ; 

		if ($resultado->num_rows>0)  
		{
			
			while($row = $resultado->fetch_assoc())  
		    {
		    	
				$idRemitente=$row["id"];
			 	
			}	 

			   	
		}
	}
	else
	{
		$mail = "";
		$idRemitente= "";
	}		
	
	
	if ($_POST["Mensaje"]!="")
	{
		

		$queryEstadoMensaje = "UPDATE usuario SET mensaje = 1 WHERE mail= '$mailUsuario'";
		$database->ejecutarQuery($queryEstadoMensaje) ;
		$queryGuardarMensaje= "insert into mensaje";
		if ($idRemitente!="")
		{
			$queryGuardarMensaje=$queryGuardarMensaje." values ('','$idUsuario','$mensaje','$idRemitente','$fechaMensaje')";
		}
		else
		{
			$queryGuardarMensaje=$queryGuardarMensaje." values ('','$idUsuario','$mensaje',NULL,'$fechaMensaje')";
		}
		
		$database->ejecutarQuery($queryGuardarMensaje) ;

	}
	else
	{
		$_POST["Mensaje"]="";
		echo " "."no";
	}


		//echo " "."se guardo";
		//echo " ".$_POST["Mensaje"];
		//echo " ".$_POST["idUsuario"];
		//ECHO " ".$mail;
		//ECHO " ".$idRemitente;
		//echo " ".$queryGuardarMensaje;

	header("location:../home.php");
?>
