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

		<!-- CUERPO -->

		  <section id="main-content" >

	        <!-- PUBLICACIONES AMIGOS -->
	       
	         <?php
	         	//se recupera el mail del usuario guardado en la cookie
				$mail = $_COOKIE["mail"];
				//se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
				$database = new BaseDeDatos();
				//select para ver las publicaciones de las mascotas que sigue el usuario activo recuperando de la tabla de publicaciones anidada con la tabla mascota (el idMascota de publicaciones con el id de mascota), anidada con la tabla seguidor (el id de mascota con el idMascota de seguidor) y anidada con la tabla usuario (el idUsuario de seguidor con el id de usuario) usuario, el texto y la imagen de la publicacion (si es que subio una imagen) y el nombre y la imagen de perfil de la mascota de la publicacion usando el mail del usuario actual guardada en la cookie en el where ordenados por la fecha de la publicacion de manera descendiente
				$queryPublicacionesDeMascotasQueSigo= "SELECT publicacion.texto as texto, publicacion.pathImagen as imagenPublicacion, publicacion.pathVideo as videoPublicacion, mascota.nombre as nombreMascota, mascota.imagen as imagenMascota, mascota.id as mascotaId FROM publicacion INNER JOIN mascota on publicacion.idMascota=mascota.id INNER JOIN seguidor on publicacion.idMascota=seguidor.idMascota INNER JOIN usuario ON seguidor.idUsuario=usuario.id where usuario.mail='$mail' ORDER BY fechaPublicacion DESC";
				//resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
				$resultado =  $database->ejecutarQuery($queryPublicacionesDeMascotasQueSigo) ;
				

				echo "<ul>";
				//se verifica si se encuentra resultados en la query para ver las publicaciones de las mascotas que sigo, si encuentra registros empieza a recorrerlos
				if ($resultado->num_rows>0)  
					{	echo "<ul>";
						//empieza a recorrer cada registro
						while($row = $resultado->fetch_assoc()) 
					    {	
					    	echo "<li>";

					    	echo "<div class='row'>";
					    	
						    	echo "<div class='col-sm-4'>";
            						echo "<div class='imgComent'>";
            							//se muestra la foto de la mascota del registro
										echo "<img src='logica/".$row["imagenMascota"]."' class='img-circle' height='55' width='55' alt='Avatar'>";
										//se muestra el nombre de la mascota del registro y el nombre redirige a su perfil
										echo "<a href='".htmlspecialchars("/Petface/perfilMascota.php?nombreMascota=".$row["mascotaId"])."'><b>".$row["nombreMascota"]."</b></a>";
										
									echo "</div>";
								echo "</div>";

								echo "<div class='col-sm-10'>";
									//se muestra el texto de la publicacion del registro
									echo "<p>".$row["texto"]."</p>";
									//si la direccion de la imagen de la publicacion no es la que tiene por defecto muestra la imagen
									if ($row["imagenPublicacion"]!="")
									{
										//se muestra la imagen de la publicacion
										echo "<img src='logica/".$row["imagenPublicacion"]."' height='150' width='150' class='imagenComentarios' alt='Avatar'>";
									}
									//si la direccion del video de la publicacion no es la que tiene por defecto muestra el video
									if ($row["videoPublicacion"]!="")
									{
										//se muestra la imagen de la publicacion
										echo "<video src='logica/".$row["videoPublicacion"]."' alt='".$row['videoPublicacion']."' controls poster='img/logo.png' width='400' height='240' border: 2px solid black;></video>";
									}
									
								echo "</div>";
							echo "</div>";

							echo "</li>";
							

							echo "---------------------------------------------------------------------------------------------";
						}
						echo "</ul>";
					}
					//si no se encuentran registro (aun no sigue a ninguna mascota) se le muestra sugerencias al azar
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
									echo "---------------------------------------------------------------------------------------------	 \n";

									echo "</li> \n";
								}
								
							}
							echo "</ul>";
					}
								
							?>

	    </section>
	</main>
	<br><br><br>

<!-- pie de pagina -->
<?php include("includes\pie.php"); ?>
	
