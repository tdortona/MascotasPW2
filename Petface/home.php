<?php include("includes\\noCookie.php"); ?>
<?php include("includes\datosUsuario.php"); ?>
<?php include("includes\cabecera.php"); ?>
<?php include("includes\\navbar.php"); ?>
<?php include("includes\menuVertical.php"); ?>
<?php
  include_once("logica/clases/BaseDeDatos.php");
  include_once("logica/clases/Usuario.php");
?>
			<!-- CUERPO -->
			
			  <section id="main-content" >

		        <!-- PUBLICACIONES AMIGOS -->
		        <form action="amigos.php" method="get" enctype="multipart/form-data">
					<input type="submit" class="btn btn-primary" value="Mis Amigos"></input>
				</form>
		        <?php
					$mail = $_COOKIE["mail"];
					$database = new BaseDeDatos();
					$queryPublicacionesDeMascotasQueSigo= "SELECT publicacion.texto as texto, publicacion.pathImagen as imagenPublicacion, publicacion.pathVideo as videoPublicacion, publicacion.id as idPublicacion, mascota.nombre as nombreMascota, mascota.imagen as imagenMascota, mascota.idTipo as tipoMascota, mascota.id as idMascota FROM publicacion INNER JOIN mascota on publicacion.idMascota=mascota.id INNER JOIN seguidor on publicacion.idMascota=seguidor.idMascota INNER JOIN usuario ON seguidor.idUsuario=usuario.id where usuario.mail='$mail' ORDER BY fechaPublicacion DESC";
					$resultado =  $database->ejecutarQuery($queryPublicacionesDeMascotasQueSigo);
					echo "<ul>";
					if ($resultado->num_rows>0)  
					{	
						while($row = $resultado->fetch_assoc()) 
						{	
							echo "<li>";

							echo "<div class='row'>";
							
								echo "<div class='col-sm-4'>";
									echo "<div class='imgComent'>";
										echo "<img src='logica/".$row["imagenMascota"]."' class='img-circle' height='55' width='55' alt='Avatar'>";
										echo $row["nombreMascota"];
										
									echo "</div>";
								echo "</div>";

								echo "<div class='col-sm-10'>";
									echo "<p>".$row["texto"]."</p>";
									if ($row["imagenPublicacion"]!="")
									{
										echo "<img src='logica/".$row["imagenPublicacion"]."' height='150' width='150' class='imagenComentarios' alt='Avatar'>";
									}
									if ($row["videoPublicacion"]!="")
									{
										echo "<video src='logica/".$row["videoPublicacion"]."' alt='".$row['videoPublicacion']."' controls poster='img/logo.png' width='400' height='240' border: 2px solid black;></video>";
									}
									
								echo "</div>";
							echo "</div>";

							echo "</li>";
							
							switch($row["tipoMascota"]){
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
							echo "	<br><div id='publicacion".$row["idPublicacion"]."' class='form-group botones'>
										<input id='meGusta".$row["idPublicacion"]."' class='btn btn-primary boton' type='button' value='".$tipoMeGusta."' onclick='meGusta(".$row["idPublicacion"].",".$idUsuario.",".$row["idMascota"].")'>
										</input>
										<input id='noMeGusta".$row["idPublicacion"]."' class='btn btn-primary boton' type='button' value='".$tipoNoMeGusta."' onclick='noMeGusta(".$row["idPublicacion"].",".$idUsuario.",".$row["idMascota"].")'>																		
										</input>
									</div>";
							echo "------------------------------------------------------------------------------------------------------------------------------";
							$pIdMascota = $row["idMascota"];
							$pIdPublicacion = $row['idPublicacion'];
							$queryTieneMgONo="select * from likepublicacion where idUsuario='$idUsuario' and idMascota='$pIdMascota' and idPublicacion='$pIdPublicacion'";
							$res = $database->ejecutarQuery($queryTieneMgONo);
							
							if ($res->num_rows>0)
							{
								$fila = $res->fetch_assoc();
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
						echo "<h4>Agregá</h4>";
					}
					echo "</ul>";
				?>
		    </section>
	</main>
	<br><br><br>
<?php include("includes\pie.php"); ?>
	
<script src="js/comentarYMeGusta.js"></script>