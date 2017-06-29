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

							<div class="navbar navbar-inverse navbar-fixed-left text-center" id="menu-vertical">
								<a class="btn btn-default" href="home.php" id="btn-volver">
							      <span class="glyphicon glyphicon-circle-arrow-left"></span>
							      Volver
							    </a>
							    <br>
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
							    	<img src="logica/<?php echo $imagenUsuario2; ?>" class="img-circle" height="70" width="70" alt="Avatar" style="position:absolute; left: 130px; top:200px;">
							    </div>
										
						    	<ul class="nav navbar-nav opciones" id="detalle-mascota">

									<?php

									    	/* Datos Mascota */

											echo "<li>Dueño: <b><a href='home.php'>".$nombreUsuario2."</a></b></li>";
											echo "<li>Especie: <b>".$tipo."</b></li>";
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
			  <!-- IMPRIMIR PERFIL EN PDF -->
				  <div class="col-sm-10" >
						<form action="exportarPDF.php"  method="post">
							<input type="hidden" name="nombreMascota" value="<?php echo $nombreMascota; ?>">
							<input type="hidden" name="owner" value="<?php echo $nombreUsuario2; ?>">
							<input type="hidden" name="especie" value="<?php echo $tipo; ?>">
							<input type="hidden" name="raza" value="<?php echo $raza; ?>">
							<input type="hidden" name="sexo" value="<?php echo $sexoMascota; ?>">
							<input type="hidden" name="fnac" value="<?php echo $fechaNacimientoMascota; ?>">
							<input type="hidden" name="fotoMascota" value="logica/<?php echo $imagenMascota; ?>">
							<input type="hidden" name="fotoUsuario" value="logica/<?php echo $imagenUsuario2; ?>">
							<input class="btn btn-primary boton" type="submit" value="Exportar a PDF">
						</form>
				  </div>			        										
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
					
					$queryPublicacionesDelPerfil= "SELECT texto as texto, pathImagen as imagenPublicacion, pathVideo as videoPublicacion, id as idPublicacion FROM publicacion where idMascota= '$idMascota' ORDER BY fechaPublicacion DESC";

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
							
							switch($idTipo){
								case 1:
									$tipoMeGusta = "¡Guau!";
									$tipoNoMeGusta = "No guau";
								break;
								case 2:
									$tipoMeGusta = "¡Miau!";
									$tipoNoMeGusta = "No miau";
								break;
								case 3:
									$tipoMeGusta = "¡Pio!";
									$tipoNoMeGusta = "No pio";
								break;
								default:
									$tipoMeGusta = "¡Me gusta!";
									$tipoNoMeGusta = "No me gusta";
								break;
							}							
							echo "	<div id='publicacion".$fila["idPublicacion"]."' class='form-group botones'>
										<input id='meGusta".$fila["idPublicacion"]."' class='btn btn-primary boton' type='button' value='".$tipoMeGusta."' onclick='meGusta(".$fila["idPublicacion"].",".$idUsuario.",".$idMascota.")'>
										</input>
										<input id='noMeGusta".$fila["idPublicacion"]."' class='btn btn-primary boton' type='button' value='".$tipoNoMeGusta."' onclick='noMeGusta(".$fila["idPublicacion"].",".$idUsuario.",".$idMascota.")'>																		
										</input>
									</div>";
							echo "------------------------------------------------------------------------------------------------------------------------------";
						}
						$queryTieneMgONo="select * from likepublicacion where idusuario='$idUsuario' and idmascota='$idMascota'";
						$resultado = $database->ejecutarQuery($queryTieneMgONo);
						
						if ($resultado->num_rows>0)
						{
							while($fila = $resultado->fetch_assoc())   
							{
								if($fila["like"] == 1)
								{
									echo "	<script type='text/javascript'>
												$('#noMeGusta".$fila["idPublicacion"]."').hide();
												$('#meGusta".$fila["idPublicacion"]."').removeClass('btn-primary boton');
												$('#meGusta".$fila["idPublicacion"]."').addClass('btn-success');
												$('#meGusta".$fila["idPublicacion"]."').prop('disabled', true);
											</script>";
								}
								else if($fila["like"] == 0)
								{
									echo "	<script type='text/javascript'>
												$('#meGusta".$fila["idPublicacion"]."').hide();
												$('#noMeGusta".$fila["idPublicacion"]."').removeClass('btn-primary boton');
												$('#noMeGusta".$fila["idPublicacion"]."').addClass('btn-danger');
												$('#noMeGusta".$fila["idPublicacion"]."').prop('disabled', true);
											</script>";
								}
								echo "<script type='text/javascript'>
										$('#publicacion".$fila["idPublicacion"]."').after('<textarea id=\"comentario".$fila["idPublicacion"]."\" rows=\"4\" cols=\"50\" maxlength=\"200\" readonly>".$fila["comentario"]."</textarea><br>');
									</script>";
							}
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

<script src="js/comentarYMeGusta.js"></script>