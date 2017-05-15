<!DOCTYPE html>
<html>
	<head>
		<title>registros</title>
	</head>
	<body>
		<?php

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

			session_start();

			if (isset($_SESSION["base"]))
				{
					foreach ($_SESSION["base"] as $key => $value) 
					{
						echo "{$key} => nombre: {$value->nombre}, clave: {$value->clave}<br> \n";
					}
				}
			else
			{
				echo "no existe ningun registro aun";
			}

			echo "\n <a href=\"home.php\">volver</a>";
		?>
	</body>
</html>