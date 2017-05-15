<!DOCTYPE html>
<html>
<head>
	<title>registro</title>
</head>
<body>
<?php 
	$usuario=$_POST["user"];
	$contraseña=$_POST["clave"];
	$estado=0;

	if(isset($_POST["user"]))
	{
		if(isset($_POST["clave"]))
		{

		}
		else
		{
			header("location:home.php");
		}
	} 
	else
	{
		header("location:home.php");
	}

	class cuenta 
	{
		public $nombre;
		public $clave;

		function __construct($nombre,$clave)
		{
			$this->nombre = $nombre;
   			$this->clave = $clave;
		}
	}


	if($usuario != "" && $contraseña != "")
		{ session_start();
			if (isset($_SESSION["base"]))
			{
				foreach ($_SESSION["base"] as $key => $value) 
				{
					
					$temporal=$value->nombre;
					if ($temporal==$usuario)
					{
						//echo ya hay un usuario con ese nombre
						$estado=1;
						break;
					}
					else
					{
						//ya existe el array, agrega la nueva cuenta
						$estado=2;
					}
				}		
				
			}
			else
			{
				//no existe el array, lo crea y agrega la primera 
				//cuenta para saber que tipo de datos va a tener dentro
				$estado=3;
			}
		}
	else
		{	
			session_start();
			//la contraseña o el usuario esta vacios
			$estado=4;
		}


	switch ($estado) {
		case 0:
			header("location:home.php");
			break;

		case 1:
			echo "<p>Ya existe un usuario con el nombre ".$temporal."</p><br> \n <a href=\"home.php\">volver</a>";
			break;

		case 2:
			$nuevo = new cuenta($usuario,$contraseña);
			print_r($nuevo);
			array_push($_SESSION["base"], $nuevo);

			echo "<p>se creo la cuenta!<p><br> \n";
			foreach ($_SESSION["base"] as $key => $value) 
			{
				echo "{$key} => nombre: {$value->nombre}, clave: {$value->clave}<br> \n";
			}

			echo "\n <a href=\"home.php\">volver</a>";
			
			break;

		case 3:
			$nuevo = new cuenta($usuario,$contraseña);
			$_SESSION["base"]=array($nuevo);
			print_r($nuevo);

			echo "<p>se creo la cuenta!<p><br> \n";
			foreach ($_SESSION["base"] as $key => $value) 
			{
				echo "{$key} => nombre: {$value->nombre}, clave: {$value->clave}<br> \n";
			}

			echo "\n <a href=\"home.php\">volver</a>";
			
			break;
		case 4:
			echo "<p>El campo usuario o contraseña estan vacios</p><br> \n <a href=\"home.php\">volver</a>";
			break;

		default:
			header("location:home.php");
			break;
	}

?> 
</body>
</html>