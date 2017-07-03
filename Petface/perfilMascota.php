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
<?php
	// las clases del objeto base de datos y usuario 
	include_once("logica/clases/BaseDeDatos.php");
	include_once("logica/clases/Usuario.php");
?>

	<main>
		<!-- MENU VERTICAL --> 
							<!-- boton que regresa al home -->
							<div class="navbar navbar-inverse navbar-fixed-left text-center" id="menu-vertical">
								<a class="btn btn-default" href="home.php" id="btn-volver">
							      <span class="glyphicon glyphicon-circle-arrow-left"></span>
							      Inicio
							    </a>
							    <br>
			    				<div class="well">
				    				<p>
					    			<!-- Nombre Mascota -->
									    <a class="navbar-brand" href="#">
									    	<!-- devuelve el valor de la variable nombreMascota que se encuentra en el include datosMascota.php -->
									    	<?php echo $nombreMascota; ?>
										</a>
									</p>
								</div>
							</br>
							    <div class="well">
							    	<p>
							        <div class="imagen">
							        	<!-- devuelve el valor de la variable imagenMascota que se encuentra en el include datosMascota.php -->
							    		<img src="logica/<?php echo $imagenMascota; ?>" class="img-circle">
							    	</div>
							    	</p>
							    	<!-- devuelve el valor de la variable imagenUsuario2 que se encuentra en el include datosMascota.php -->
							    	<img src="logica/<?php echo $imagenUsuario2; ?>" class="img-circle" height="70" width="70" alt="Avatar" style="position:absolute; left: 130px; top:200px;">
							    </div>
										
						    	<ul class="nav navbar-nav opciones" id="detalle-mascota">

									<?php

									    	/* Datos Mascota */
									    	//devuelve el valor de la variable nombreUsuario2 que se encuentra en el include datosMascota.php 
											echo "<li>Dueño: <b><a href='home.php'>".$nombreUsuario2."</a></b></li>";
											//devuelve el valor de la variable tipo que se encuentra en el include datosMascota.php
											echo "<li>Especie: <b>".$tipo."</b></li>";
											//devuelve el valor de la variable raza que se encuentra en el include datosMascota.php
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
											echo "<li>Nació el: <b>".$fechaNacimientoMascota."</b></li>";
											echo "<li>Edad: <b>".$edad."</b></li>";
											echo "<li>Estoy <b>".$nombreEstado."</b></li>";

											$database = new BaseDeDatos();
											$mail = $_COOKIE["mail"];

											$queryEsMiMascotaONo="select * from mascota inner join usuario on mascota.idUsuario=usuario.id where usuario.mail='$mail' and mascota.id='$idMascota'";

											$resultado =  $database->ejecutarQuery($queryEsMiMascotaONo) ;

											if ($resultado->num_rows>0)
											{
												echo"
													<form action='codigoQR.php' method='GET'>
													<input type='hidden' name='idMascota' value='".$idMascota."'>
													<input type='hidden' name='nombreMascota' value='".$nombreMascota."'>
													<button class='btn btn-info boton' type='submit'>
			                    						<span class='glyphicon glyphicon-qrcode'></span>
														Código QR
			                						</button>
			                						</form>";
											}

								echo '</ul>';

								if ($resultado->num_rows>0) 
								{
									echo '<input type="hidden" id="idm" value="'.$idMascota.'"></input>';
									echo'
									<select id="estado_cambio">
									<option  value="" selected="selected">
									
										-- Elija una opción --
									</option>
									<option  value="1">
									
										En casa
									</option>
									<option  value="2">
									
										Perdido
									</option>
									<option  value="3">
									
										En adopción
									</option>';
						
							if ($sexoMascota=="H")
								{
									echo '<option id="opc" value="4">
									
											Embarazada
										</option>';
								}
								echo '</select>';
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
							<input type="hidden" name="estado" value="<?php echo $nombreEstado; ?>">
							<input class="btn btn-primary boton" type="submit" value="Exportar a PDF">
						</form>
				  </div>	
			        

			        <!-- PUBLICACIÓN -->

			     <?php 
				     $database = new BaseDeDatos();
				     $mail = $_COOKIE["mail"];

				     $queryEsMiMascotaONo="select * from mascota inner join usuario on mascota.idUsuario=usuario.id where usuario.mail='$mail' and mascota.id='$idMascota'";
					$esMiMascota = $resultado->num_rows>0;
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
					//se recupera el mail del usuario guardado en la cookie
					$mail = $_COOKIE["mail"];

					//se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
					$database = new BaseDeDatos();
					
					//query para ver todas las publicaciones de la mascota de este perfil usando la tabla publicacion obteniendo el campo texto como texto y pathImagen como imagenPublicacion usando el id de la mascota definido en la variable idMascota del include datosMascota.php en el where ordenandolas por la fechaPublicacion de manera desendiente
					$queryPublicacionesDelPerfil= "SELECT texto, pathImagen as imagenPublicacion, pathVideo as videoPublicacion, id as idPublicacion, fechaPublicacion FROM publicacion where publicacion.idMascota= '$idMascota' ORDER BY fechaPublicacion DESC";

					//resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
					$resultado =  $database->ejecutarQuery($queryPublicacionesDelPerfil) ;
					
					echo "<ul>";
					//verifica si encuentra resultados para para la query de ver las publicaciones del perfil de la mascota, si no entra el else
					if ($resultado->num_rows>=0) 
					{
						//empieza a recorrer los registros
						while($fila = $resultado->fetch_assoc())   
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
								echo "</div>";
								
								echo "<div class='container'>";
									echo "<ul class='list-unstyled list-thumbs row'>";
											//se muestra el texto de la publicacion
											echo "<p>".$fila["texto"]."</p>";
											echo "<p>".$fila["fechaPublicacion"]."</p>";
											//si el campo "imagenPublicacion" no tiene la ubicacion por defecto, muestra la imagen, si no, no lo hace
											if ($fila["imagenPublicacion"]!="")
											{	
												echo"<li class='col-lg-3 col-sm-4 col-xs-6'>";
													echo "<img src='logica/".$fila["imagenPublicacion"]."' height='230' width='230' class='imagenComentarios' alt='Avatar'>";
												echo"</li>";
											}

											//si el campo "videoPublicacion" no tiene la ubicacion por defecto, muestra la imagen, si no, no lo hace
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
											
											switch($tipo){
												case "perro":												
													$tipoMeGusta = "¡Guau!";
													$tipoNoMeGusta = "No guau";
												break;
												case "gato":												
													$tipoMeGusta = "¡Miau!";
													$tipoNoMeGusta = "No miau";
												break;
												case "pajaro":												
													$tipoMeGusta = "¡Pio!";
													$tipoNoMeGusta = "No pio";
												break;
												default:
													$tipoMeGusta = "¡Me gusta!";
													$tipoNoMeGusta = "No me gusta";
												break;
											}
											if(!$esMiMascota){
												echo "	<div id='publicacion".$fila["idPublicacion"]."' class='form-group botones'>
															<input id='meGusta".$fila["idPublicacion"]."' class='btn btn-primary boton' type='button' value='".$tipoMeGusta."' onclick='meGusta(".$fila["idPublicacion"].",".$idUsuario.",".$idMascota.")'>
															</input>
															<input id='noMeGusta".$fila["idPublicacion"]."' class='btn btn-primary boton' type='button' value='".$tipoNoMeGusta."' onclick='noMeGusta(".$fila["idPublicacion"].",".$idUsuario.",".$idMascota.")'>																		
															</input>
														</div>";
											}										
											
											
											
											echo "---------------------------------------------------------------------------------------------";

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
						echo "<h4>Esta mascota no ha hecho ninguna publicación aún</h4>";
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
<script src="js/comentarYMeGusta.js"></script>