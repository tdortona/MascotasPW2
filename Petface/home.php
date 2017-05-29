<?php include("includes\\noCookie.php"); ?>
<?php include("includes\cabecera.php"); ?>
<?php include("includes\\navbar.php"); ?>
	<main>
		<!-- MENU VERTICAL --> 
			<?php
				$mail = $_COOKIE["mail"];
				$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
				$sql= "SELECT mascota.nombre as nombre, usuario.imagen as imagenUsuario, tipo.tipo as tipo, raza.raza as raza, mascota.fechaNacimiento as fechaNacimiento, mascota.sexo as sexo FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id INNER JOIN tipo ON mascota.idTipo=tipo.id INNER JOIN raza ON mascota.idRaza=raza.id where usuario.mail= '$mail' ";
				$result = mysqli_query($conexion,$sql);
				?>

				<div class="navbar navbar-inverse navbar-fixed-left">
				    <a class="navbar-brand" href="#"><?php echo $nombre; ?></a>
					    
					<div class="well">
			    		<img src="logica/<?php echo $imagen ?>" class="img-circle" height="150" width="150" alt="" style="margin-left: 20px;">
					</div>
				    
				    <ul class="nav navbar-nav">

				    	<li class="dropdown">
				    		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				    			Mascotas <span class="caret"></span>
				    		</a>
					       <ul class="dropdown-menu dropup" role="menu" aria-labelledby="dLabel">
								<?php

									if (mysqli_num_rows($result)>0) 
									{
										while($row = mysqli_fetch_assoc($result)) 
									    {	
									 		echo "<li>";
										    echo 	'<a href="' . htmlspecialchars("/Petface/perfilMascota.php?nombre=" .$row["nombre"]) . '">'."\n";
											echo 	"<h4>".$row["nombre"]."</h4> </a>";
											echo "</li>" ;
										}
									}
									else
									{
										echo "<h4>Agregá</h4>";
									}
								?>
								<form action="mascotas_registro.php" method="GET" enctype="multipart/form-data">
									<input type="submit" class="btn btn-default boton btn-lg" value="Registrar mascota"></input>
								</form>
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

			  <!-- ----- -->

			<!-- CUERPO -->

			  <section id="main-content" >
			     
			        <!-- PUBLICACIÓN -->
			    <form action="logica\confirm_publicacion.php" method="POST" enctype="multipart/form-data">    
			      <div class="col-sm-10" >
			        <div class="panel panel-default"  >
			          <div class="panel-heading" style="background-image: linear-gradient(90deg, #309971, #2d2d2d); color: white; font-size: 20px;"><strong>Publicación</strong> </div>
			            <div class="panel-body">
			              <div class="input-group image-preview">
			                
			              </div>
			              
			              <!-- Comentarios -->
			              <textarea class="form-control" rows="2" id="comment" placeholder="¡Comentario acá..!" id="texto" name="texto" <?php if (isset($_SESSION["texto"]) and $_SESSION["texto"]!='') {echo 'value="'.$_SESSION["texto"].'"'; $_SESSION["texto"]='';} ?>></textarea>
			              
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

			      <?php
					$mail = $_COOKIE["mail"];
					$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
					$sql= "SELECT publicacion.texto as texto FROM publicacion INNER JOIN mascota ON mascota.id=publicacion.idMascota INNER JOIN usuario ON mascota.idUsuario=usuario.id where usuario.mail= '$mail' ";
					$result = mysqli_query($conexion,$sql);
					
					echo "<ul>";
					if (mysqli_num_rows($result)>=0) 
									{
										while($row = mysqli_fetch_assoc($result)) 
									    {	
									 		echo "<li>";
											echo 	"<h4>".$row["texto"]."</h4>";
											echo "</li>";
											
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
	<form action="logica\logout.php" method="POST">
		<input type="submit" class="btn btn-primary btn-block" value="salir"></input>
	</form>
	
<?php include("includes\pie.php"); ?>
	
<?php include("includes\pie.php"); ?>
