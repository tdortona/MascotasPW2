<?php include("includes\\noCookie.php"); ?>
<?php include("includes\cabecera.php"); ?>
<?php include("includes\\navbar.php"); ?>

	<main>
		<!-- MENU VERTICAL --> 
				
						<?php

				        $nombre = $_GET['nombre'];
						$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
						$sql= "SELECT mascota.nombre as nombre, mascota.imagen as imagen, usuario.imagen as imagenUsuario, usuario.nombre as nombreUsuario, tipo.tipo as tipo, raza.raza as raza, mascota.fechaNacimiento as fechaNacimiento, mascota.sexo as sexo FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id INNER JOIN tipo ON mascota.idTipo=tipo.id INNER JOIN raza ON mascota.idRaza=raza.id where usuario.mail= '$mail' and mascota.nombre ='".$_GET['nombre']."' ";
						$result = mysqli_query($conexion,$sql);

						if (mysqli_num_rows($result)>0) 
							{
						
						while($row = mysqli_fetch_assoc($result)) 
					    	{
							
						?>
							<div class="navbar navbar-inverse navbar-fixed-left">
			    			
				    			<!-- Nombre Mascota -->
							    <a class="navbar-brand" href="#">
							    	<?php echo $row['nombre']; ?>
								</a>

							    <div class="well">
							        
							    	<img src="logica/<?php echo $row['imagen']; ?>" class="img-circle" height="150" width="150" alt="<?php echo $row['imagen']; ?>">
							    	<img src="logica/<?php echo $row['imagenUsuario']; ?>" class="img-circle" height="70" width="70" alt="Avatar" style="position:absolute; left: 120px; top:150px;">
							    </div>
										
						    	<ul class="nav navbar-nav">

							<?php

							    	/* Datos Mascota */

									echo "<li>Dueño: <b>".$row["nombreUsuario"]."</b></li>";
									echo "<li>Tipo: <b>".$row["tipo"]."</b></li>";
									echo "<li>Raza: <b>".$row["raza"]."</b></li>";
									if ($row["sexo"]=="H")
										{
											echo "<li>Sexo:<b> Hembra</b></li>";
										}
									else
										{
											echo "<li>Sexo:<b> Macho</b></li>";
										}
									echo "<li>Fecha de nacimiento: <b>".$row["fechaNacimiento"]."</b></li>";
									}
									}
									else
									{
										echo "<h4>Aun no agrego sus mascota, agregue la primera!</h4>";
									}
							?>
								</ul>
								
								<form action="mascotas_registro.php" method="POST">
									<input type="submit" class="btn btn-primary" value="registrar mascota"></input>
								</form>	
								<hr style="left:150px; bottom:520px;">
							</div>
							
		<!-- fin MENU VERTICAL --> 

			  <!-- ----- -->

			<!-- CUERPO -->
			
			  <section id="main-content" >
			        

			        <!-- PUBLICACIÓN -->

			      <div class="col-sm-10" >
			        <div class="panel panel-default"  >
			          <div class="panel-heading" style="background-image: linear-gradient(90deg, #309971, #2d2d2d); color: white; font-size: 20px;"><strong>Publicación</strong> </div>
			            <div class="panel-body">
			              <div class="input-group image-preview">
			                
			              </div>
			              
			              <!-- Comentarios -->
			              <textarea class="form-control" rows="2" id="comment" placeholder="¡Comentario acá..!"></textarea>
			              
			              <br />
			              <div class="form-group botones">
			                <button class="btn btn-default boton btn-lg" type="submit">
			                    
			                    Enviar
			                </button>
			                <button class="btn btn-default boton " type="submit" style=" position: relative; top: 5px;">
			                    <span class="glyphicon glyphicon-camera"></span>
			                    Foto
			                </button>
			                <button class="btn btn-default boton" type="submit" style=" position: relative; top: 5px;">
			                    <span class="glyphicon glyphicon-facetime-video"></span>
			                    Video
			                </button>
			            </div>
			          </div>
			        </div>
			      </div>

		      	<!-- fin PUBLICACIÓN -->


		        <!-- PUBLICACIONES AMIGOS -->
		        

		        <div class="row">
		          
		          <div class="col-sm-4">
		            <div class="imgComent">
		               <img src="img/fotoAmigo.jpg" class="img-circle" height="55" width="55" alt="Avatar">
		               Coraje
		            </div>
		          </div>
		          
		          <div class="col-sm-10">
		              <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.
		              </p>

		              <img src="img/mascota.jpg" height="150" width="150" class="imagenComentarios" alt="Avatar">
		            </div>
		        </div> 

		        <div class="row" >
		          
		          <div class="col-sm-4">
		            <div class="imgComent">
		               <img src="img/fotoAmigo.jpg" class="img-circle" height="55" width="55" alt="Avatar">
		               Coraje
		            </div>
		          </div>
		          
		          <div class="col-sm-10">
		              <p>Just Forgot that I had to mention something about someone to someone about how I forgot something, but now I forgot it. Ahh, forget it! Or wait. I remember.... no I don't.
		              </p>

		              <img src="img/mascota.jpg" height="150" width="150" class="imagenComentarios" alt="Avatar">
		            </div>
		        </div> 

		    </section>
	</main>
	<br><br><br>
	
<?php include("includes\pie.php"); ?>