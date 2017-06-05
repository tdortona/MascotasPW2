<!-- verifica si no esta seteada una cookie, si no lo esta no permite entrar a esta pagina, devuelve al index -->
<?php include("includes\\noCookie.php"); ?>
<!-- setea variables con todos los datos de la mascota en especifico usando el id de la mascota pasado por el url-->
<?php include("includes\datosMascota.php"); ?>
<!-- setea variables con los valores del usuario para usarlos en la pagina usando la cookie que contiene su mail -->
<?php include("includes\datosUsuario.php"); ?>
<!-- cebezera con hojas de estilo y scripts -->
<?php include("includes\cabecera.php"); ?>
<!-- barra de navegacion -->
<?php include("includes\\navbar.php"); ?>

	<main>
		<!-- MENU VERTICAL --> 
				
						
							<div class="navbar navbar-inverse navbar-fixed-left">
			    			
				    			<!-- Nombre Mascota -->
							    <a class="navbar-brand" href="#">
							    	<!-- devuelve el valor de la variable nombreMascota que se encuentra en el include datosMascota.php -->
							    	<?php echo $nombreMascota; ?>
								</a>

							    <div class="well">
							        <!-- devuelve el valor de la variable imagenMascota que se encuentra en el include datosMascota.php -->
							    	<img src="logica/<?php echo $imagenMascota; ?>" class="img-circle" height="150" width="150" alt="Avatar mascota">
							    	<!-- devuelve el valor de la variable imagenUsuario2 que se encuentra en el include datosMascota.php -->
							    	<img src="logica/<?php echo $imagenUsuario2; ?>" class="img-circle" height="70" width="70" alt="Avatar" style="position:absolute; left: 120px; top:150px;">
							    </div>
										
						    	<ul class="nav navbar-nav">

							<?php

							    	/* Datos Mascota */
							    	//devuelve el valor de la variable nombreUsuario2 que se encuentra en el include datosMascota.php 
									echo "<li>Dueño: <b>".$nombreUsuario2."</b></li>";
									//devuelve el valor de la variable tipo que se encuentra en el include datosMascota.php
									echo "<li>Tipo: <b>".$tipo."</b></li>";
									//devuelve el valor de la variable raza que se encuentra en el include datosMascota.php -->
									echo "<li>Raza: <b>".$raza."</b></li>";
									//devuelve el valor de la variable sexo que se encuentra en el include datosMascota.php. Si es H es hembra entra al if, si no, es macho y entra al else
									if ($sexoMascota=="H")
										{
											echo "<li>Sexo:<b> Hembra</b></li>";
										}
									else
										{
											echo "<li>Sexo:<b> Macho</b></li>";
										}
									//devuelve el valor de la variable fechaNacimeintoMascota que se encuentra en el include datosMascota.php
									echo "<li>Fecha de nacimiento: <b>".$fechaNacimientoMascota."</b></li>";
									
							?>
								</ul>
								<!-- por alguna razon en mi monitor si saco este boton, la barra lateral que separa el menu vertical con el resto del contenedo, se desliza a la derecha deformando la vista -->
								<form action="mascotas_registro.php" method="POST">
									<input type="submit" class="btn btn-primary" value="Registrar mascota"></input>
								</form>	
								<hr style="left:150px; bottom:520px;">
							</div>
							
		<!-- fin MENU VERTICAL --> 

			  <!-- -->

			<!-- CUERPO -->
			
			  <section id="main-content" >
			        

			        <!-- PUBLICACIÓN -->
			    <!-- php para verificar si el usuario activo es dueño de la mascota del perfil que se esta viendo-->
			    <?php 
				    //select para ver si existe una relacion entre la mascota y el usuario activo usando la tabla mascota anidad con la de usuario usando en el where el id de la mascota por medio de la variable idMascota que se encuentra en el include datosMascota.php y el mail del usuario activo seteado en la cookie
				    $sql3="SELECT * FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id WHERE usuario.mail='$mail' and mascota.id='$idMascota'";
				    //query del resultado
				    $result3=mysqli_query($conexion,$sql3);
				    //verifica si hay resultados para la query de coincidencia de mascota-usaurio, si no entra al else
					if (mysqli_num_rows($result3)>0)
				    {
				    	//devuelve el include que permite publicar en este perfil
				    	include("includes\publicacion.php"); 
					}
					else
					{
						//devuelve el include que permite seguir al perfil de la mascota si no es perteneciente al usaurio
						include("includes\seguirPerfil.php"); 
					}
				?>
			      	<!-- MUESTRO LA PUBLICACIÓN -->	
			    <?php
			    	//define una variable mail con el valor que se encuentra dentro de la cookie para obtener el mail del usuario activo
					$mail = $_COOKIE["mail"];
					//quiery de conexion
					$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
					//query para ver todas las publicaciones de la mascota de este perfil usando la tabla publicacion obteniendo el campo texto como texto y pathImagen como imagenPublicacion usando el id de la mascota definido en la variable idMascota del include datosMascota.php en el where ordenandolas por la fechaPublicacion de manera desendiente
					$sql= "SELECT texto as texto, pathImagen as imagenPublicacion FROM publicacion where idMascota= '$idMascota' ORDER BY fechaPublicacion DESC";
					//query del resultado
					$result = mysqli_query($conexion,$sql);
					
					echo "<ul>";
					//verifica si encuentra resultados para para la query de ver las publicaciones del perfil de la mascota, si no entra el else
					if (mysqli_num_rows($result)>=0) 
					{
						//empieza a recorrer los registros
						while($row = mysqli_fetch_assoc($result)) 
					    {	
					    	echo "<li>";

					    	echo "<div class='row'>";
					    	
						    	echo "<div class='col-sm-4'>";
            						echo "<div class='imgComent'>";
            							//se muestra la foto de perfil de la masctoa de la variable imagenMascota del include datosMascota.php
										echo "<img src='logica/".$imagenMascota."' class='img-circle' height='55' width='55' alt='Avatar'>";
										//se muestra el noombre de la masctoa de la variable nombreMascota del include datosMascota.php
										echo $nombreMascota;
									echo "</div>";
								echo "</div>";

								echo "<div class='col-sm-10'>";
									//se muestra el texto de la publicacion
									echo "<p>".$row["texto"]."</p>";
									//si el campo "imagenPublicacion" no tiene la ubicacion por defecto, muestra la imagen, si no, no lo hace
									if ($row["imagenPublicacion"]!="Imagen Publicacion/")
									{
										echo "<img src='logica/".$row["imagenPublicacion"]."' height='150' width='150' class='imagenComentarios' alt='Avatar'>";
									}
								echo "</div>";
							echo "</div>";

							echo "</li>";

							echo "------------------------------------------------------------------------------------------------------------------------------";
						}
					}
					else
					{
						//si no se encontraron publicaciones de esta mascota se muestra el siguiente mensaje
						echo "<h4>Esta mascota no ha hecho ninguna publicacion aun</h4>";
					}
					echo "</ul>";
				?>

				
			      
			    </form>

		      	<!-- fin PUBLICACIÓN -->
  

		    </section>
	</main>
	<br><br><br>
<!-- pie de pagina -->
<?php include("includes\pie.php"); ?>