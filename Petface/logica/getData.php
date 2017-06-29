<?php 
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");
	
	$database = new BaseDeDatos();
	$querySumLikes= "SELECT `likepublicacion`.`idMascota` as mascotaId,
							SUM(`likepublicacion`.`like`) as likeCount,
							`mascota`.`nombre` as nombreMascota,
							`mascota`.`idTipo` as tipoMascota
					FROM `likepublicacion`
					INNER JOIN `mascota`
					ON `likepublicacion`.`idMascota` = `mascota`.`id`
					GROUP BY `likepublicacion`.`idMascota`
					ORDER BY likeCount DESC
					LIMIT 3";
	$resultado =  $database->ejecutarQuery($querySumLikes);
	
	$dataTable = array(array("NombreMascota", "CantidadLikes"));
	
	$string = '{
				  "cols": [
						{"id":"","label":"NombreMascota","pattern":"","type":"string"},
						{"id":"","label":"CantidadLikes","pattern":"","type":"number"}
					  ],
				  "rows": [';
	
	while($fila = $resultado->fetch_assoc()) 
	{
		//$dataTable[] = array($fila['nombreMascota'], (int)$fila['likeCount']);
		$string = $string.'{"c":[{"v":"'.$fila['nombreMascota'].'","f":null},{"v":'.$fila['likeCount'].',"f":null}]},';
	}
	$string = substr($string, 0, -1);
	$string = $string.']}';
		
	echo $string;
?>