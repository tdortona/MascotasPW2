<?php
//incluimos las clases existentes
include_once("logica/clases/BaseDeDatos.php");
include_once("logica/clases/Usuario.php");
//iniciamos la variable que contiene el objeto BaseDeDatos
$database = new BaseDeDatos();
//recuperamos la palabra a buscar
if (isset($_GET["busqueda"]) && $_GET["busqueda"]!="")
{
	$busqueda=$_GET["busqueda"];
	echo "se busco la palabra: ".$busqueda."<br> \n";
}
else
{
	$busqueda="";
}
// contador que va a servir para verificar si al final de todas las busquedas no encontro nada, si no encontro nada en cada busqueda va aumentando en 1 el cantador, si lleda a 3 (el numero actual de busquedas) muestra el mensaje de que no se encontro nada
$contadorSinResultados=0;

//[idea](resultados a array) para el autocompletar de la barra de navegacion se puede tirar resulados en un array para mostrarlo en el autocompletar
$array=array();

//si la busqueda no esta vacia
if ($busqueda!="")
{
	//query de busqueda, busca coincidencias por nombre buscando lo que se escribio tanto al principio, final y dentro de los nombres
	$queryResultadosDeBusquedaPorNombres="select nombre as mascotaNombre, id as mascotaId from mascota where nombre like '%".$busqueda."%' ";
	//query de busqueda, busca coincidencias por tipo buscando lo que se escribio al principio del tipo
	$queryResultadosDeBusquedaPorTipo="select tipo as tipo from tipo where tipo like '".$busqueda."%' ";
	//query de busqueda, busca coincidencias por raza buscando lo que se escribio al principio de la raza 
	$queryResultadosDeBusquedaPorRaza="select raza as raza, tipo as razaTipo from raza inner join tipo on raza.idTipo=tipo.id where raza like '".$busqueda."%' order by raza ";

	//resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
	$resultadoResultadosDeBusquedaPorNombres =  $database->ejecutarQuery($queryResultadosDeBusquedaPorNombres);
	$resultadoResultadosDeBusquedaPorTipo =  $database->ejecutarQuery($queryResultadosDeBusquedaPorTipo);
	$resultadoResultadosDeBusquedaPorRaza =  $database->ejecutarQuery($queryResultadosDeBusquedaPorRaza);
	
	//se crea la lista en la vista
	echo "<ul>  \n";
	//si el resultado de la busqueda de tipo encontro registros los muestras
	if ($resultadoResultadosDeBusquedaPorTipo->num_rows>0)  
		{	
			//pasa por cada registro y lo muestra
			while($fila = $resultadoResultadosDeBusquedaPorTipo->fetch_assoc()) 
		    {	
		    	echo "<li> \n";
		    	echo "*Tipo: ".$fila["tipo"]."  \n";
		    	//[idea](resultados a array) se agrega el tipo al array con su descripcion
		    	$array[]= $fila["tipo"]."</a> - tipo<br>";
		    	echo "</li>  \n";
				

				echo "------------------------------------------------------------------------------------------------------------------------------ \n";
			}
			
		}
	else
		{
			//si la busqueda no encontro recultados similares suma 1 al contador
			$contadorSinResultados+=1;
		}
	//si el resultado de la busqueda de tipo encontro registros los muestras	
	if ($resultadoResultadosDeBusquedaPorRaza->num_rows>0)  
		{	
			//pasa por cada registro y lo muestra
			while($fila = $resultadoResultadosDeBusquedaPorRaza->fetch_assoc()) 
		    {	
		    	echo "<li> \n";
		    	echo "*Raza: ".$fila["razaTipo"]."s ".$fila["raza"]."  \n";
		    	//[idea](resultados a array) se agrega la raza al array con su descripcion
		    	$array[]= $fila["raza"]."</a> - raza<br>";
		    	echo "</li> \n";
				

				echo "------------------------------------------------------------------------------------------------------------------------------ \n";
			}
			
		}
	else
		{
			//si la busqueda no encontro recultados similares suma 1 al contador
			$contadorSinResultados+=1;
		}
	//si el resultado de la busqueda de tipo encontro registros los muestras	
	if ($resultadoResultadosDeBusquedaPorNombres->num_rows>0)  
		{	
			//pasa por cada registro y lo muestra
			while($fila = $resultadoResultadosDeBusquedaPorNombres->fetch_assoc()) 
		    {	
		    	echo "<li> \n";
		    	echo "*Mascota: ".$fila["mascotaNombre"]." <a href='".htmlspecialchars("/Petface/perfilMascota.php?nombreMascota=".$fila["mascotaId"])."'>Ir al perfil</a> \n";
		    	//[idea](resultados a array) se agrega la mascota al array con su descripcion
		    	$array[]="<a href='".htmlspecialchars("/Petface/perfilMascota.php?nombreMascota=".$fila["mascotaId"])."'>".$fila["mascotaNombre"]."</a> - mascota<br>";
		    	echo "</li> \n";
				

				echo "------------------------------------------------------------------------------------------------------------------------------ \n";
			}
			
		}
	else
		{
			//si la busqueda no encontro recultados similares suma 1 al contador
			$contadorSinResultados+=1;
		}

	echo "</ul> \n";

	//si el contador llega a 3 significa que de las 3 busquedas ninguna dio resultados asi que muestra el sigiente mensaje
	if ($contadorSinResultados==3)
		{
			echo "<h3>No se encontro ningun resultado</h3> \n";
		}

	//recorre y muestra el array
	/*foreach ($array as $value) {
		echo $value." \n";
	}*/
}
//si la busqueda esta vacia no se encontro ningun resultado
else
{
	echo "<h3>No se encontro ningun resultado</h3> \n";
}

echo "<br> \n";
echo '<a href="home.php">Inicio</a>'." \n";

/*
	muy importante!!!! ordenar por distancia, funciona!!!!
	SELECT longitud, latitud, 
(
    6371 * 
    acos(cos(radians(-2))* <---- latitud
	cos(radians(latitud))*
    cos(radians(longitud)-
    radians(-1))+ <---- longitud
    sin(radians(-2))* <-----latitud
    sin(radians(latitud)))
) as distance
FROM ubicacion
order by distance
*/
?>