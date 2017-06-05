<!-- verifica si no esta seteada una cookie, si no lo esta no permite entrar a esta pagina, devuelve al index -->
<?php include("includes\\noCookie.php"); ?>
<!-- setea variables con los valores del usuario para usarlos en la pagina usando la cookie que contiene su mail-->
<?php include("includes\datosUsuario.php"); ?>
<!-- cebezera con hojas de estilo y scripts -->
<?php include("includes\cabecera.php"); ?>
<!-- barra de navegacion -->
<?php include("includes\\navbar.php"); ?>
	<main>
		<!-- MENU VERTICAL --> 
			

				<div class="navbar navbar-inverse navbar-fixed-left">
				<!-- se recuera el nombre del usuario -->
				    <a class="navbar-brand" href="#"><?php echo $nombreUsuario; ?></a>
					    
					<div class="well">
					<!-- se recupera la foto de perfil del usuario -->
			    		<img src="logica/<?php echo $imagenUsuario ?>" class="img-circle" height="150" width="150" alt="" style="margin-left: 20px;">
					</div>
				     
				    <!-- dropdownlist para ver las mascotas del usuario activo -->
				    <ul class="nav navbar-nav">
				    		<li class="dropdown">
				    		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				    			Mascotas <span class="caret"></span>
				    		</a>
					       <ul class="dropdown-menu dropup" role="menu" aria-labelledby="dLabel">
				    		<!-- se lista todas las mascotas del usuario -->
									<?php
									//query de conexion
									 $connectVerMascotas=mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
									 //select para ver las mascotas del usuario activo donde se recupera el nombre y el id de las mascotas del usuario usuando su mail en el where
									 $sqlVerMascotas = "SELECT mascota.nombre as nombre, mascota.id as id FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id where usuario.mail= '$mail' ";
									 //query del resultado
									 $resultVerMascotas = mysqli_query($connectVerMascotas, $sqlVerMascotas);

									//se verifica si se encuentra resultados en la query para ver las mascotas del usuario, si encuentra registros empieza a recorrerlos, si no ingresa al else
									if (mysqli_num_rows($resultVerMascotas)>0) 
									{
										//se empeza a recorrer cada registro
										while($row = mysqli_fetch_assoc($resultVerMascotas)) 
									    {	
									    	//se hace un echo con el link que lleva al perfil de las mascota poniendo un get con el id de las mascota, recuperado del registro, al final del link y el titulo con el nombre recuperado de la mascota en el cual se puede hacer clic
									 		echo "<li>";
									 		//link con el id del registro actual
										    echo 	'<a href="' . htmlspecialchars("/Petface/perfilMascota.php?nombreMascota=" .$row["id"]) . '">'."\n";
										    //nombre de la mascota del registro actual
											echo 	"<h4>".$row["nombre"]."</h4> </a>";
											echo "</li>" ;
										}
									}
									else
									{
										//si no se encontraron registros aparece este mensaje que es un link al registro de mascotas
										echo "<li>";
									    echo 	'<a href="mascotas_registro.php">'."\n";
										echo 	"<h4>Agregá tu primera mascota! click aqui</h4> </a>";
										echo "</li>" ;
									}
								?>
					       </ul>
				     	</li>

					     <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Grupos <span class="caret"></span></a>
					       
					       <ul class="dropdown-menu dropup" role="menu" aria-labelledby="dLabel">
					        <li><a href="#">Grupo 1</a></li>
					        <li><a href="#">Grupo 2</a></li>
					        <li><a href="#">Grupo 3</a></li>
					        <li class="divider"></li>
					        <li><a href="#">Sub Menu4</a></li>
					        <li><a href="#">Sub Menu5</a></li>
					       </ul>
					     </li>
				    	
					     <li><a href="#">Adopción</a></li>
					     <li><a href="#">Solos & Solas</a></li>
					     <li><a href="#">Cachorros</a></li>
					     <li><a href="#">Mascotas Perdidas</a></li>
				    
				     
				    </ul>
				    <hr>
				</div>

		<!-- fin MENU VERTICAL --> 

			  <!--  -->

			<!-- CUERPO -->

			  <section id="main-content" >

		        <!-- PUBLICACIONES AMIGOS -->
		        
		         <?php
		         	//se recupera el mail del usuario guardado en la cookie
					$mail = $_COOKIE["mail"];
					//query de conexion
					$conexionPublicacionesDeMascotasQueSigo = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
					//select para ver las publicaciones de las mascotas que sigue el usuario activo recuperando de la tabla de publicaciones anidada con la tabla mascota (el idMascota de publicaciones con el id de mascota), anidada con la tabla seguidor (el id de mascota con el idMascota de seguidor) y anidada con la tabla usuario (el idUsuario de seguidor con el id de usuario) usuario, el texto y la imagen de la publicacion (si es que subio una imagen) y el nombre y la imagen de perfil de la mascota de la publicacion usando el mail del usuario actual guardada en la cookie en el where ordenados por la fecha de la publicacion de manera descendiente
					$sqlPublicacionesDeMascotasQueSigo= "SELECT publicacion.texto as texto, publicacion.pathImagen as imagenPublicacion, mascota.nombre as nombreMascota, mascota.imagen as imagenMascota FROM publicacion INNER JOIN mascota on publicacion.idMascota=mascota.id INNER JOIN seguidor on publicacion.idMascota=seguidor.idMascota INNER JOIN usuario ON seguidor.idUsuario=usuario.id where usuario.mail='$mail' ORDER BY fechaPublicacion DESC";
					//query del resultado
					$resultPublicacionesDeMascotasQueSigo = mysqli_query($conexionPublicacionesDeMascotasQueSigo,$sqlPublicacionesDeMascotasQueSigo);
					
					echo "<ul>";
					//se verifica si se encuentra resultados en la query para ver las publicaciones de las mascotas que sigo, si encuentra registros empieza a recorrerlos
					if (mysqli_num_rows($resultPublicacionesDeMascotasQueSigo)>0) 
									{
										//empieza a recorrer cada registro
										while($row = mysqli_fetch_assoc($resultPublicacionesDeMascotasQueSigo)) 
									    {	
									    	echo "<li>";

									    	echo "<div class='row'>";
									    	
										    	echo "<div class='col-sm-4'>";
				            						echo "<div class='imgComent'>";
				            						//se muestra la foto de la mascota del registro
														echo "<img src='logica/".$row["imagenMascota"]."' class='img-circle' height='55' width='55' alt='Avatar'>";
														//se muestra el nombre de la mascota del registro
														echo $row["nombreMascota"];
													echo "</div>";
												echo "</div>";

												echo "<div class='col-sm-10'>";
												//se muestra el texto de la publicacion del registro
													echo "<p>".$row["texto"]."</p>";
													//si la direccion de la imagen de la publicacion no es la que tiene por defecto muestra la imagen
													if ($row["imagenPublicacion"]!="Imagen Publicacion/")
													{
														//se muestra la imagen de la publicacion
														echo "<img src='logica/".$row["imagenPublicacion"]."' height='150' width='150' class='imagenComentarios' alt='Avatar'>";
													}
													
												echo "</div>";
											echo "</div>";

											echo "</li>";

											echo "------------------------------------------------------------------------------------------------------------------------------";
										}
									}
									
					echo "</ul>";
								?>

		    </section>
	</main>
	<br><br><br>

<!-- pie de pagina -->
<?php include("includes\pie.php"); ?>
	
