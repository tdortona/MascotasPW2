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
					$queryPublicacionesDeMascotasQueSigo= "SELECT publicacion.texto as texto, publicacion.pathImagen as imagenPublicacion, publicacion.pathVideo as videoPublicacion, mascota.nombre as nombreMascota, mascota.imagen as imagenMascota FROM publicacion INNER JOIN mascota on publicacion.idMascota=mascota.id INNER JOIN seguidor on publicacion.idMascota=seguidor.idMascota INNER JOIN usuario ON seguidor.idUsuario=usuario.id where usuario.mail='$mail' ORDER BY fechaPublicacion DESC";
					$resultado =  $database->ejecutarQuery($queryPublicacionesDeMascotasQueSigo) ;
					

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
											

											echo "------------------------------------------------------------------------------------------------------------------------------";
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
	
