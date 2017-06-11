<?php include("includes\\noCookie.php"); ?>
<?php include("includes\datosMascota.php"); ?>
<?php include("includes\datosUsuario.php"); ?>
<?php include("includes\cabecera.php"); ?>
<?php include("includes\\navbar.php"); ?>
<?php
  include_once("logica/clases/BaseDeDatos.php");
  include_once("logica/clases/Usuario.php");
?>

	<main>
		<!-- MENU VERTICAL --> 

							<div class="navbar navbar-inverse navbar-fixed-left">
								<a class="btn btn-default" href="home.php">
							      <span class="glyphicon glyphicon-circle-arrow-left"></span>
							      Volver
							    </a>

			    				<div class="well">
				    				<p>
					    			<!-- Nombre Mascota -->
									    <a class="navbar-brand" href="#">
									    	<?php echo $nombreMascota; ?>
										</a>
									</p>
								</div>
							</br>
							    <div class="well">
							    	<p>
							        <div class="imagen">
							    		<img src="logica/<?php echo $imagenMascota; ?>" class="img-circle">
							    	</div>
							    	</p>
							    	<img src="logica/<?php echo $imagenUsuario2; ?>" class="img-circle" height="70" width="70" alt="Avatar" style="position:absolute; left: 130px; top:180px;">
							    </div>
										
						    	<ul class="nav navbar-nav">

									<?php

									    	/* Datos Mascota */

											echo "<li>Dueño: <b><a href='home.php'>".$nombreUsuario2."</a></b></li>";
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
									<input type="submit" class="btn btn-primary" value="Registrar Mascota"></input>
								</form>	

								<!-- Poner en Adopción -->
								
								<?php 

										if ($idEstadoMascota == "1")
											{	
												echo "<p>";
												echo "<form action=logica/confirm_adopcion.php?idMascota=".$idMascota."&nombreMascota=".$nombreMascota." method='POST'>";
												echo "<input type='checkbox' name='enviar' value=".$idMascota."> <b>¡Ponerme en Adopción!</b><br>";
												echo "<input type='submit' class='btn btn-primary' value='Enviar'>";
												echo "</form></p>";
											}
										if ($idEstadoMascota == "3")
											{
											
												echo "</br>";
												echo "<h4> Su Mascota está en Adopción </h4>";
												echo "<form action=logica/confirm_dejarAdopcion.php?idMascota=".$idMascota."&nombreMascota=".$nombreMascota." method='POST'>";
												echo "<input type='checkbox' name='enviar' value=".$idMascota."> <b>¡Salir de Adopción!</b><br>";
												echo "<input type='submit' class='btn btn-danger' value='Enviar'>";
												echo "</form>";
											}
								?>
								<hr style="position: absolute; left:260px; bottom:720px;">
							</div>
							
		<!-- fin MENU VERTICAL --> 

			  <!-- ----- -->

			<!-- CUERPO -->
			
			  <section id="main-content" >
			        

			        <!-- PUBLICACIÓN -->

			     <?php 
				     $database = new BaseDeDatos();
				     $mail = $_COOKIE["mail"];

				     $queryEsMiMascotaONo="select * from mascota inner join usuario on mascota.idUsuario=usuario.id where usuario.mail='$mail' and mascota.id='$idMascota'";

				    $resultado =  $database->ejecutarQuery($queryEsMiMascotaONo) ;

					if ($resultado->num_rows>0)
				    {
				    	include("includes\publicacion.php"); 
					}
					else
					{
						include("includes\seguirPerfil.php"); 
					}
				?>
			      	<!-- MUESTRO LA PUBLICACIÓN -->	
			      <?php
					$mail = $_COOKIE["mail"];
					$database = new BaseDeDatos();
					
					$queryPublicacionesDelPerfil= "SELECT texto as texto, pathImagen as imagenPublicacion, pathVideo as videoPublicacion FROM publicacion where idMascota= '$idMascota' ORDER BY fechaPublicacion DESC";

					$resultado =  $database->ejecutarQuery($queryPublicacionesDelPerfil) ;
					
					echo "<ul>";
					if ($resultado->num_rows>=0) 
									{
										while($fila = $resultado->fetch_assoc())   
									    {	
									    	echo "<li>";

										    	echo "<div class='row'>";
										    	
											    	echo "<div class='col-sm-4'>";
					            						echo "<div class='imgComent'>";
															echo "<img src='logica/".$imagenMascota."' class='img-circle' height='55' width='55' alt='Avatar'>";
															echo $nombreMascota;
														echo "</div>";
													echo "</div>";
												echo "</div>";
												
												echo "<div class='container'>";
													echo "<ul class='list-unstyled list-thumbs row'>";
													
															echo "<p>".$fila["texto"]."</p>";
															if ($fila["imagenPublicacion"]!="")
															{	echo	"<li class='col-lg-3 col-sm-4 col-xs-6'>";
																echo "<img src='logica/".$fila["imagenPublicacion"]."' height='230' width='230' class='imagenComentarios' alt='Avatar'>";
																echo	"</li>";
															}

													
															if ($fila["videoPublicacion"]!="")
															{	
																
																echo	"<li class='col-lg-3 col-sm-4 col-xs-6'>";
																echo "<video src='logica/".$fila["videoPublicacion"]."' alt='".$fila['videoPublicacion']."' controls poster='img/logo.png' width='400' height='240' border: 2px solid black;>";
																echo "</video>";
																echo	"</li>";
																
															}
													echo "</ul>";
												echo "</div>";

											echo "</li>";
											
											?>
												<div class="form-group botones">
									                <button class="btn btn-primary boton" type="submit">
									                    <span class="glyphicon glyphicon-thumbs-up"></span>
									                    Me gusta
									                </button>
									                <button class="btn btn-primary boton" type="submit">
									                    <span class="glyphicon glyphicon-thumbs-down"></span>
									                    No me gusta
									                </button>
									            </div>
											
											<?php
											
											echo "------------------------------------------------------------------------------------------------------------------------------";
										
									
											


										}
									}
									else
									{
										echo "<h4>Esta mascota no ha hecho ninguna publicacion aun</h4>";
									}
					echo "</ul>";
								?>

				
			      
			    </form>

		      	<!-- fin PUBLICACIÓN -->

		    </section>
	</main>
	<br><br><br>
	
<?php include("includes\pie.php"); ?>