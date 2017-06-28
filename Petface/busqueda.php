<!-- verifica si no esta seteada una cookie, si no lo esta no permite entrar a esta pagina, devuelve al index -->
<?php include("includes\\noCookie.php"); ?>
<!-- setea variables con los valores del usuario para usarlos en la pagina usando la cookie que contiene su mail -->
<?php include("includes\datosUsuario.php"); ?>
<!-- cebezera con hojas de estilo y scripts -->
<?php include("includes\cabecera.php"); ?>
<!-- barra de navegacion -->
<?php include("includes\\navbar.php"); ?>
<!-- menu lateral del usuario -->
<?php include("includes\menuVertical.php"); ?>

<?php
	// las clases del objeto base de datos y usuario 
	include_once("logica/clases/BaseDeDatos.php");
	include_once("logica/clases/Usuario.php");
?>


<!-- CUERPO -->

	<section id="main-content" >

		<div class="col-sm-12">
			<form  role="search" action="busqueda.php" method="GET">
		        <div class="form-group input-group col-sm-3">
					<input name="busqueda" type="text" class="form-control " placeholder="" >
					<span class="input-group-btn">
	            		<button class="btn btn-default" type="submit">
							Buscar
	            		</button>
	          		</span>        
		        </div>
		        <div ng-app="myapp" ng-controller="usercontroller" ng-init="load_tipo()" class="form-group">  
			        <div class="form-group  col-sm-3">
			        	<select id="tipo" name="tipo" ng-model="tipo" class="form-control" ng-change="load_raza()">  
							<option value="">- Elija una especie -</option>  
							<option ng-repeat="tipo in tipos" value="{{tipo.id}}">{{tipo.tipo}}</option>  
						</select>
			        </div>
			        <div class="form-group col-sm-3">
			        	<select id="raza" name="raza" ng-model="raza" class="form-control" class="form-group">  
							<option value="" selected="selected" >- Elija una raza -</option>  
							<option ng-repeat="raza in razas" value="{{raza.id}}">{{raza.raza}}</option>  
						</select>  
			        </div>
		        </div>      
			</form>
	    </div>

	    <?php

	        //se recupera el mail del usuario guardado en la cookie
			$mail = $_COOKIE["mail"];

			//se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
			$database = new BaseDeDatos();

			//se verifica que al menos uno de los get pasados por url esten seteados
	        if (isset($_GET["busqueda"]) or isset($_GET["tipo"]) or isset($_GET["raza"]) )
			{
				//si el get que tiene la palabra a buscar esta seteado le pasa el valor a la variable de busqueda
				if (isset($_GET["busqueda"]))
				{
					$busqueda=$_GET["busqueda"];
				}
				//si no pone un valor vacio a la variable
				else
				{
					$busqueda="";
				}

				//si el get que tiene el tipo a buscar esta seteado le pasa el valor a la variable de busqueda
				if (isset($_GET["tipo"]))
				{
					$busquedaTipo=$_GET["tipo"];
				}
				//si no pone un valor vacio a la variable
				else
				{
					$busquedaTipo="";
				}

				//si el get que tiene la raza a buscar esta seteado le pasa el valor a la variable de busqueda
				if (isset($_GET["raza"]))
				{
					$busquedaRaza=$_GET["raza"];
				}
				//si no pone un valor vacio a la variable
				else
				{
					$busquedaRaza="";
				}
					
				//en esta parte se va a verificar cuales variables tienen un valor y se va a mostar que es lo que se esta buscando
				//primero se prueba con la palabra a buscar, si no es un valor vacio muestra eso
				if ($busqueda!="")
				{
					echo "<h5>Resultados con: ".$busqueda."</h5><br> \n";
				}
				//si el valor de la palabra buscada esta vacio, se muestra la raza que se busco
				elseif ($busquedaRaza!="") 
				{
					$queryResultadosDeBusquedaPorRaza="select raza as raza, tipo as razaTipo from raza inner join tipo on raza.idTipo=tipo.id where raza.id='".$busquedaRaza."'";
					$resultadoResultadosDeBusquedaPorRaza =  $database->ejecutarQuery($queryResultadosDeBusquedaPorRaza);
					//si el resultado de la busqueda de tipo encontro registros los muestras	
					if ($resultadoResultadosDeBusquedaPorRaza->num_rows>0)  
					{	
						//pasa por cada registro y lo muestra
						while($fila = $resultadoResultadosDeBusquedaPorRaza->fetch_assoc()) 
					    {	
					    	$razaRaza=$fila["raza"];
					    }
					}
					echo "<h5>Resultados con: ".$razaRaza."</h5><br> \n";
				}
				//si tambien esta vacia el valor de la variable de la busqueda de raza, se muestra la busqueda de la variable tipo
				elseif ($busquedaTipo!="") 
				{
					$queryResultadosDeBusquedaPorTipo="select tipo from tipo  where id='".$busquedaTipo."'";
					$resultadoResultadosDeBusquedaPorTipo =  $database->ejecutarQuery($queryResultadosDeBusquedaPorTipo);
					//si el resultado de la busqueda de tipo encontro registros los muestras	
					if ($resultadoResultadosDeBusquedaPorTipo->num_rows>0)  
					{	
						//pasa por cada registro y lo muestra
						while($fila = $resultadoResultadosDeBusquedaPorTipo->fetch_assoc()) 
					    {	
					    	$tipoTipo=$fila["tipo"];
					    }
					}
					echo "<h5>Resultados con: ".$tipoTipo."</h5><br> \n";
				}
				//si llega a este punto algo funciona mal y deberia revisarse el codigo
				else
				{
					echo "<h5>Algo salió mal, pruebe con otra búsqueda</h5>";
				}
			}
			//si no se encontro ningun get setado le pasa valores en blanco a las variables de busqueda
			else
			{
				$busqueda="";
				$busquedaTipo="";
				$busquedaRaza="";
			}

			//si la busqueda por palabra no esta vacia
			if ($busqueda!="")
			{
				//query de busqueda, busca coincidencias por nombre buscando lo que se escribio tanto al principio, final y dentro de los nombres. Solo se buscan las mascotas que no son del usuario activo
				$queryResultadosDeBusquedaPorNombres="select mascota.nombre as mascotaNombre, mascota.id as mascotaId, mascota.imagen as mascotaImagen, raza.raza as mascotaRaza, tipo.tipo as mascotaTipo, mascota.sexo as mascotaSexo, mascota.fechaNacimiento as mascotaFechaNacimiento,CAST((3959 *acos(cos(radians(".$latitud.")) * cos(radians(usuario.latitud)) * cos(radians(usuario.longitud) - radians(".$longitud.")) + sin(radians(".$latitud.")) * sin(radians(usuario.latitud )))) AS decimal(10, 3)) AS distance  from mascota inner join raza on mascota.idRaza=raza.id inner join tipo on mascota.idTipo=tipo.id inner join usuario on mascota.idUsuario=usuario.id where usuario.mail!='".$mail."' and  mascota.nombre like '%".$busqueda."%' ORDER BY distance LIMIT 0, 20; ";
			}
			//si la busqueda por palabra esta vacia, hace una busqueda de todas las mascotas menos las del usuario activo
			else
			{
				$queryResultadosDeBusquedaPorNombres="select mascota.nombre as mascotaNombre, mascota.id as mascotaId, mascota.imagen as mascotaImagen, raza.raza as mascotaRaza, tipo.tipo as mascotaTipo, mascota.sexo as mascotaSexo, mascota.fechaNacimiento as mascotaFechaNacimiento from mascota inner join raza on mascota.idRaza=raza.id inner join tipo on mascota.idTipo=tipo.id inner join usuario on mascota.idUsuario=usuario.id where usuario.mail!='".$mail."' ";
			}

			//si la busqueda por tipo tiene un valor se agrega el filtro por tipo
			if ($busquedaTipo!="")
			{
				$queryResultadosDeBusquedaPorNombres=$queryResultadosDeBusquedaPorNombres."and tipo.id=".$busquedaTipo." ";
			}

			//si la busqueda por raza tiene un valor se agrega el filtro por raza
			if ($busquedaRaza!="")
			{
				$queryResultadosDeBusquedaPorNombres=$queryResultadosDeBusquedaPorNombres."and raza.id=".$busquedaRaza." ";
			}

		
			

			//resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
			$resultadoResultadosDeBusquedaPorNombres =  $database->ejecutarQuery($queryResultadosDeBusquedaPorNombres);

			//si alguna de las busquedas tiene un valor que no sea vacio significa que algo por mostrar hay
			if ($busqueda!="" or $busquedaTipo!="" or $busquedaRaza!="")
			{
				//se crea la lista en la vista
				echo "<ul>  \n";
				
				//si el resultado de la busqueda de tipo encontro registros los muestras	
				if ($resultadoResultadosDeBusquedaPorNombres->num_rows>0)  
					{	
						//pasa por cada registro y lo muestra
						while($fila = $resultadoResultadosDeBusquedaPorNombres->fetch_assoc()) 
					    {	
					    	echo "<li> \n";

					    	//a lo largo de los echos va usando los resultados de los campos del registro actual
					    	echo "<div class='row'>";    	
						    	echo "<div class='col-sm-8'>";
	        						echo "<div class='imgComent'>";
										echo "<img src='logica/".$fila["mascotaImagen"]."' class='img-circle' height='55' width='55' alt='Avatar'> <a href='".htmlspecialchars("/Petface/perfilMascota.php?nombreMascota=".$fila["mascotaId"])."'><b>".$fila["mascotaNombre"]."</b></a> \n";
										echo "<br>";
										echo "<div class='col-sm-9'>";
											echo "<div class='col-sm-4'>";
												echo "*Tipo: <b>".$fila["mascotaTipo"]."</b>";
											echo "</div>";
											echo "<div class='col-sm-6'>";
												echo "*Raza: <b>".$fila["mascotaRaza"]."</b>";
											echo "</div>";
											echo "<div class='col-sm-4'>";
												echo "*Sexo: <b>";
												if ($fila["mascotaRaza"]=="H"){echo "Hembra";}else{echo "Macho";}
												echo "</b>";
											echo "</div>";
											echo "<div class='col-sm-6'>";
												echo "*Nacio en: <b>".$fila["mascotaFechaNacimiento"]."</b>";
											echo "</div>";
										echo "</div>";
									echo "</div>";
								echo "</div>";
							echo "</div>";



							echo "------------------------------------------------------------------------------------------------------------------------------ \n";

							echo "</li> \n";
						}	
					}
				//si no encontro ninguna coincidencia, muestra el siguiente mensaje
				else
				{
					echo "<h3>No se encontró ningún resultado</h3> \n";
				}

				echo "</ul> \n";
			}
			//si la busqueda esta vacia muestra sugerencias al azar
			else
			{
				echo "<h3>¿Qué desea buscar?</h3> \n";
				echo "<br> \n";
									
				//select: para ver sugerencias de mascotas para seguir recuperando nombre, id, imagen, fecha de nacimiento, sexo (de la tabla mascota), raza (de la tabla raza), tipo (de la tabla tipo) anidada con la tabla raza (mascota.idRaza=raza.id), la tabla tipo (mascota.idTipo=tipo.id) y la tabla usuario (mascota.idUsuario=usuario.id) usando en el where el mail del usuario para NO traer las mascotas del usuario ordenado de forma aleatoria con un total de 10 mascotas
				$queryMascotasAlAzar="select mascota.nombre as mascotaNombre, mascota.id as mascotaId, mascota.imagen as mascotaImagen, raza.raza as mascotaRaza, tipo.tipo as mascotaTipo, mascota.sexo as mascotaSexo, mascota.fechaNacimiento as mascotaFechaNacimiento from mascota inner join raza on mascota.idRaza=raza.id inner join tipo on mascota.idTipo=tipo.id inner join usuario on mascota.idUsuario=usuario.id where usuario.mail!='".$mail."' order by rand() limit 10";

				//resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
				$resultadoMascotasAlAzar =  $database->ejecutarQuery($queryMascotasAlAzar);
				//se crea la lista en la vista
				echo "<ul>  \n";
				
				//si el resultado de la busqueda de tipo encontro registros los muestras	
				if ($resultadoMascotasAlAzar->num_rows>0)  
				{	
					//pasa por cada registro y lo muestra
					while($fila = $resultadoMascotasAlAzar->fetch_assoc()) 
				    {	
				    	//a lo largo de los echos va usando los resultados de los campos del registro actual
				    	echo "<li> \n";
				    	echo "<div class='row'>";    	
					    	echo "<div class='col-sm-8'>";
	    						echo "<div class='imgComent'>";
									echo "<img src='logica/".$fila["mascotaImagen"]."' class='img-circle' height='55' width='55' alt='Avatar'> <a href='".htmlspecialchars("/Petface/perfilMascota.php?nombreMascota=".$fila["mascotaId"])."'><b>".$fila["mascotaNombre"]."</b></a> \n";
									echo "<br>";
									echo "<div class='col-sm-10'>";
										echo "<div class='col-sm-4'>";
											echo "*Tipo: <b>".$fila["mascotaTipo"]."</b>";
										echo "</div>";
										echo "<div class='col-sm-6'>";
											echo "*Raza: <b>".$fila["mascotaRaza"]."</b>";
										echo "</div>";
										echo "<div class='col-sm-4'>";
											echo "*Sexo: <b>";
											if ($fila["mascotaRaza"]=="H"){echo "Hembra";}else{echo "Macho";}
											echo "</b>";
										echo "</div>";
										echo "<div class='col-sm-6'>";
											echo "*Nació en: <b>".$fila["mascotaFechaNacimiento"]."</b>";
										echo "</div>";
									echo "</div>";
								echo "</div>";
							echo "</div>";
						echo "</div>";

						echo "------------------------------------------------------------------------------------------------------------------------------ \n";

						echo "</li> \n";
					}
				}
				echo "</ul>";
			}

			unset($_GET["busqueda"]);    
			unset($_GET["tipo"]);    
			unset($_GET["raza"]);    

		?>

	</section>
</main>
<br><br><br>

<!-- pie de pagina -->	
<?php include("includes\pie.php"); ?>
	
