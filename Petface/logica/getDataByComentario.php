<?php 
	include_once("clases/BaseDeDatos.php");
	include_once("clases/Usuario.php");
	
	$database = new BaseDeDatos();
	$querySumLikes= "SELECT `likepublicacion`.`idMascota` as mascotaId,
							COUNT(*) as commentCount,
							`mascota`.`nombre` as nombreMascota
					FROM `likepublicacion`
					INNER JOIN `mascota`
					ON `likepublicacion`.`idMascota` = `mascota`.`id`
					WHERE `likepublicacion`.`comentario` <> null OR `likepublicacion`.`comentario` <> ''
					GROUP BY `likepublicacion`.`idMascota`
					ORDER BY commentCount DESC
					LIMIT 3";
	$resultado =  $database->ejecutarQuery($querySumLikes);
	
	$string = '{
				  "cols": [
						{"id":"","label":"NombreMascota","pattern":"","type":"string"},
						{"id":"","label":"CantidadComentarios","pattern":"","type":"number"}
					  ],
				  "rows": [';
	
	while($fila = $resultado->fetch_assoc()) 
	{		
		$string = $string.'{"c":[{"v":"'.$fila['nombreMascota'].'","f":null},{"v":'.$fila['commentCount'].',"f":null}]},';
	}
	$string = substr($string, 0, -1);
	$string = $string.']}';
		
	echo $string;
?>