<!DOCTYPE html>
<html>
<head>
	<title>inicio</title>
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
						if ($contraseña==$value->clave)
						{
							//se encontro al usuario y la contraseña
							$estado=1;
							break;
						}
						else
						{
							//la contraseña no coincide
							$estado=2;
							break;
						}	
					}
					else
					{
						//no existre el usuario
						$estado=3;
					}
				}		
				
			}
			else
			{
				//no existe ningun usuario todavia
				$estado=4;
			}
		}
	else
		{	
			session_start();
			//la contraseña o el usuario esta vacios
			$estado=5;
		}


	switch ($estado) {
		case 0:
			header("location:home.php");
			break;

		case 1:
			echo "<p>El usuario ".$usuario." ha iniciado sesion</p><br> \n <a href=\"home.php\">volver</a>";
			break;

		case 2:
			echo "<p>La contraseña no coincide</p><br> \n <a href=\"home.php\">volver</a>";
			break;

		case 3:
			echo "<p>El usuario ".$usuario." no existe</p><br> \n <a href=\"home.php\">volver</a>";

			break;

		case 4:
			echo "<p>El usuario ".$usuario." no existe</p><br> \n <a href=\"home.php\">volver</a>";
			break;

		case 5:
			echo "<p>El campo usuario o contraseña estan vacios</p><br> \n <a href=\"home.php\">volver</a>";
			break;

		default:
			header("location:home.php");
			break;
	}

?> 
</body>
</html>