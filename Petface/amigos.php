<!-- verifica si no esta seteada una cookie, si no lo esta no permite entrar a esta pagina, devuelve al index -->
<?php include("includes\\noCookie.php"); ?>
<!-- setea variables con los valores del usuario para usarlos en la pagina usando la cookie que contiene su mail-->
<?php include("includes\datosUsuario.php"); ?>
<!-- cebezera con hojas de estilo y scripts -->
<?php include("includes\cabecera.php"); ?>
<!-- barra de navegacion -->
<?php include("includes\\navbar.php"); ?>
<!-- menu lateral del usuario -->
<?php include("includes\menuVertical.php"); ?>
<!-- las clases del objeto base de datos y usuario -->
<?php
  include_once("logica/clases/BaseDeDatos.php");
  include_once("logica/clases/Usuario.php");
?>

		<section id="main-content" >
			<ul class="list-unstyled list-thumbs row">
				<h3>Mascotas a las que sigo: </h3>
				</br>
				<?php
				 	//se recupera el mail del usuario guardado en la cookie
					$mail = $_COOKIE["mail"];
					//se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
					$database = new BaseDeDatos();
					
					//select para devolver todas las mascotas que sigue el usuario activo
					$queryMascotasQueSigue= "SELECT mascota.nombre as nombreMascota, mascota.imagen as imagenMascota, mascota.id as id, tipo.tipo as tipo, raza.raza as raza, mascota.fechaNacimiento as fechaNacimiento, mascota.sexo as sexo FROM mascota INNER JOIN seguidor on mascota.id=seguidor.idMascota INNER JOIN usuario ON seguidor.idUsuario=usuario.id INNER JOIN tipo ON mascota.idTipo=tipo.id INNER JOIN raza ON mascota.idRaza=raza.id where usuario.mail='$mail' ";
					//resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
					$resultado =  $database->ejecutarQuery($queryMascotasQueSigue) ;

					//se verifica si se encuentra resultados en la query para ver las mascotas que sigue el usuario activo
					if ($resultado->num_rows>0)  
					{
						//empieza a recorrer cada registro
						while($row = $resultado->fetch_assoc()) 
					    {
							//a lo largo de los echos va usando los resultados de los campos del registro actual
							echo "<li class='col-lg-3 col-sm-4 col-xs-6'>";
							echo '<a>'."\n";
							echo " <h2>".$row["nombreMascota"]."</h2><br> ";
							?> <img src="logica/<?php echo $row['imagenMascota']; ?>" class="img-responsive">
							<?php

							echo "Tipo: ".$row["tipo"]."<br>\n";
							echo "Raza: ".$row["raza"]."<br>\n";
							if ($row["sexo"]=="H")
							{
								echo "Sexo: Hembra<br>\n";
							}
							else
							{
								echo "Sexo: Macho<br>\n";
							}
							echo "Nacio el: ".$row["fechaNacimiento"]."<br>\n";

							echo
							'<form action="perfilMascota.php" method="GET" enctype="multipart/form-data">
								<input type="hidden" name="nombreMascota" value="'.$row["id"].'">
								<input type="submit" class="btn btn-primary" value="Ir al perfil"></input>
								
							</form>';
							echo "</a></li>";
						}
					}
				else
				{
					echo "<h4>Aún no sigues a ninguna mascota! te sugerimos ver las siguientes! </h4> \n";
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
												while($row = $resultadoMascotasAlAzar->fetch_assoc()) 
											    {	
											    	echo "<li> \n";


											    	echo "<div class='row'>";    	
												    	echo "<div class='col-sm-8'>";
						            						echo "<div class='imgComent'>";
																echo "<img src='logica/"./*ruta de la imagen de la fila*/$row["mascotaImagen"]."' class='img-circle' height='55' width='55' alt='Avatar'> <a href='".htmlspecialchars("/Petface/perfilMascota.php?nombreMascota="./*id de la mascota de la fila para pasarlo en la url de perfilMascota.php*/$row["mascotaId"])."'><b>"./*nombre de la mascota del registro*/$row["mascotaNombre"]."</b></a> \n";
																echo "<br>";
																echo "<div class='col-sm-10'>";
																	echo "<div class='col-sm-4'>";
																		echo "*Tipo: <b>"./*tipo de la mascota de la fila*/$row["mascotaTipo"]."</b>";
																	echo "</div>";
																	echo "<div class='col-sm-6'>";
																		echo "*Raza: <b>"./*raza de la mascota de la fila*/$row["mascotaRaza"]."</b>";
																	echo "</div>";
																	echo "<div class='col-sm-4'>";
																		echo "*Sexo: <b>";
																		if (/*sexo de la mascota de la fila*/$row["mascotaRaza"]=="H"){echo "Hembra";}else{echo "Macho";}
																		echo "</b>";
																	echo "</div>";
																	echo "<div class='col-sm-6'>";
																		echo "*Nacio en: <b>"./*fecha de nacimiento de la mascota de la fila*/$row["mascotaFechaNacimiento"]."</b>";
																	echo "</div>";
																echo "</div>";
															echo "</div>";
														echo "</div>";
													echo "</div>";

													//super linea divisora deluxe
													echo "------------------------------------------------------------------------------------------------------------------------------ \n";

													echo "</li> \n";
												}
												
											}
											echo "</ul>";
				}
				?>
			</ul>
		</section>
	</main>
	
<!-- pie de pagina -->
<?php include("includes\pie.php"); ?>