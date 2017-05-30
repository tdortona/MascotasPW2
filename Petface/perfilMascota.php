<?php include("includes\\noCookie.php"); ?>
<?php include("includes\datosMascota.php"); ?>
<?php include("includes\datosUsuario.php"); ?>
<?php include("includes\cabecera.php"); ?>
<?php include("includes\\navbar.php"); ?>

	<main>
		<!-- MENU VERTICAL --> 
				
						
							<div class="navbar navbar-inverse navbar-fixed-left">
			    			
				    			<!-- Nombre Mascota -->
							    <a class="navbar-brand" href="#">
							    	<?php echo $nombreMascota; ?>
								</a>

							    <div class="well">
							        
							    	<img src="logica/<?php echo $imagenMascota; ?>" class="img-circle" height="150" width="150" alt="Avatar mascota">
							    	<img src="logica/<?php echo $imagenUsuario2; ?>" class="img-circle" height="70" width="70" alt="Avatar" style="position:absolute; left: 120px; top:150px;">
							    </div>
										
						    	<ul class="nav navbar-nav">

							<?php

							    	/* Datos Mascota */

									echo "<li>Dueño: <b>".$nombreUsuario2."</b></li>";
									echo "<li>Tipo: <b>".$tipo."</b></li>";
									echo "<li>Raza: <b>".$raza."</b></li>";
									if ($sexoMascota=="H")
										{
											echo "<li>Sexo:<b> Hembra</b></li>";
										}
									else
										{
											echo "<li>Sexo:<b> Macho</b></li>";
										}
									echo "<li>Fecha de nacimiento: <b>".$fechaNacimientoMascota."</b></li>";
									
							?>
								</ul>
								
								<form action="mascotas_registro.php" method="POST">
									<input type="submit" class="btn btn-primary" value="Registrar mascota"></input>
								</form>	
								<hr style="left:150px; bottom:520px;">
							</div>
							
		<!-- fin MENU VERTICAL --> 

			  <!-- ----- -->

			<!-- CUERPO -->
			
			  <section id="main-content" >
			        

			        <!-- PUBLICACIÓN -->

			     <form action="logica\confirm_publicacion.php" method="POST" enctype="multipart/form-data">    
			      <div class="col-sm-10" >
			        <div class="panel panel-default"  >
			          <div class="panel-heading" style="background-image: linear-gradient(90deg, #309971, #2d2d2d); color: white; font-size: 20px;">
			          	<strong>Publicación</strong> 
			          </div>
			            <div class="panel-body">
			              <div class="input-group image-preview">
			                
			              </div>
			              
			              <!-- Comentarios -->
			              <textarea class="form-control" rows="2" placeholder="¡Comentario acá..!" id="texto" name="texto"></textarea>
			              <input type="hidden" name="idMascota" value="<?php echo $idMascota; ?>">
			              <br />
			              <div class="form-group botones">
			                <button class="btn btn-default boton btn-lg" type="submit">
			                    
			                    Enviar
			                </button>
							<label class="btn btn-default btn-file">
						    	<span class="glyphicon glyphicon-camera"></span>
						    	Imagen 
						    	<input type="file" style="display: none;" id="pathImagen" name="pathImagen">
							</label>

			                <label class="btn btn-default btn-file">
	    						<span class="glyphicon glyphicon-facetime-video"></span>
	    						Video
	    						<input type="file" style="display: none;" id="pathVideo" name="pathVideo">
							</label>
			            </div>
			          </div>
			        </div>
			      </div>

			      	<!-- MUESTRO LA PUBLICACIÓN -->	
			      <?php
					$mail = $_COOKIE["mail"];
					$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
					$sql= "SELECT texto as texto, pathImagen as pathImagen FROM publicacion where idMascota= '$idMascota' ORDER BY fechaPublicacion DESC";
					$result = mysqli_query($conexion,$sql);
					
					echo "<ul>";
					if (mysqli_num_rows($result)>=0) 
									{
										while($row = mysqli_fetch_assoc($result)) 
									    {	
									    	echo "<li>";

									    	echo "<div class='row'>";
									    	
										    	echo "<div class='col-sm-4'>";
				            						echo "<div class='imgComent'>";
														echo "<img src='logica/".$imagenMascota."' class='img-circle' height='55' width='55' alt='Avatar'>";
														echo $nombreMascota;
													echo "</div>";
												echo "</div>";

												echo "<div class='col-sm-10'>";
													echo "<p>".$row["texto"]."</p>";
													echo "<img src='logica/".$row["pathImagen"]."' height='150' width='150' class='imagenComentarios' alt='Avatar'>";
												echo "</div>";
											echo "</div>";

											echo "</li>";

											echo "------------------------------------------------------------------------------------------------------------------------------";
										}
									}
									else
									{
										echo "<h4>Agregá</h4>";
									}
					echo "</ul>";
								?>

				
			      
			    </form>

		      	<!-- fin PUBLICACIÓN -->


		        <!-- PUBLICACIONES AMIGOS -->
		        

		        <!--div class="row">
		          
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
		        </div--> 

		    </section>
	</main>
	<br><br><br>
	
<?php include("includes\pie.php"); ?>