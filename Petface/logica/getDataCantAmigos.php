<?php 
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");
	
	$database = new BaseDeDatos();
	$querySumSeguidores= "SELECT `seguidor`.`idMascota` as mascotaID,
								 COUNT(*) as cantSeguidores,
								 `mascota`.`nombre` as nombreMascota
						  FROM `seguidor`
						  INNER JOIN `mascota`
						  ON `mascota`.`id` = `seguidor`.`idMascota`
						  GROUP BY `seguidor`.`idMascota`
						  LIMIT 3";
	$resultado =  $database->ejecutarQuery($querySumSeguidores);
	
	$string = '[["NombreMascota", "CantAmigos"],';
	
	while($fila = $resultado->fetch_assoc()) 
	{		
		$string = $string.'["'.$fila['nombreMascota'].'", '.$fila['cantSeguidores'].'],';
	}
	$string = substr($string, 0, -1);
	$string = $string.']';
		
	echo $string;
?>