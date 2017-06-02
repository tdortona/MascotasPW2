<?php include("includes\\noCookie.php"); ?>
<?php include("includes\datosUsuario.php"); ?>
<?php include("includes\cabecera.php"); ?>
<?php include("includes\\navbar.php"); ?>
	<main>
		<!-- MENU VERTICAL --> 
			

				<div class="navbar navbar-inverse navbar-fixed-left">
				    <a class="navbar-brand" href="#"><?php echo $nombreUsuario; ?></a>
					    
					<div class="well">
			    		<img src="logica/<?php echo $imagenUsuario ?>" class="img-circle" height="150" width="150" alt="" style="margin-left: 20px;">
					</div>
				    
				    <ul class="nav navbar-nav">
				    		<li class="dropdown">
				    		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
				    			Mascotas <span class="caret"></span>
				    		</a>
					       <ul class="dropdown-menu dropup" role="menu" aria-labelledby="dLabel">
				    		<!--	<form method="get" action="perfilMascota.php">
									<div ng-app="myapp" ng-controller="usercontroller" ng-init="load_mascota()" class="form-group">  
				                     
				                     <select id="mascota" name="nombreMascota" ng-model="mascota" class="form-control" onchange='if(this.value != 0) { this.form.submit(); }'>  
				                          <option value="0">elija una mascota</option>  
				                          <option ng-repeat="mascota in mascotas" value="{{mascota.id}}">{{mascota.nombre}}</option>  
				                     </select>  
			                     
									</div>
								</form>  -->
									<?php


 $connectVerMascotas=mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
 $sqlVerMascotas = "SELECT mascota.nombre as nombre, mascota.id as id FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id where usuario.mail= '$mail' "; 
 $resultVerMascotas = mysqli_query($connectVerMascotas, $sqlVerMascotas);

									if (mysqli_num_rows($resultVerMascotas)>0) 
									{
										while($row = mysqli_fetch_assoc($resultVerMascotas)) 
									    {	
									 		echo "<li>";
										    echo 	'<a href="' . htmlspecialchars("/Petface/perfilMascota.php?nombreMascota=" .$row["id"]) . '">'."\n";
											echo 	"<h4>".$row["nombre"]."</h4> </a>";
											echo "</li>" ;
										}
									}
									else
									{
										echo "<h4>Agregá</h4>";
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

			  <!-- ----- -->

			<!-- CUERPO -->

			  <section id="main-content" >

		        <!-- PUBLICACIONES AMIGOS -->
		        
		         <?php
					$mail = $_COOKIE["mail"];
					$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
					$sql= "SELECT publicacion.texto as texto, publicacion.pathImagen as imagenPublicacion, mascota.nombre as nombreMascota, mascota.imagen as imagenMascota FROM publicacion INNER JOIN mascota on publicacion.idMascota=mascota.id INNER JOIN seguidor on publicacion.idMascota=seguidor.idMascota INNER JOIN usuario ON seguidor.idUsuario=usuario.id where usuario.mail='$mail' ORDER BY fechaPublicacion DESC";
					$result = mysqli_query($conexion,$sql);
					
					echo "<ul>";
					if (mysqli_num_rows($result)>0) 
									{
										while($row = mysqli_fetch_assoc($result)) 
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
										echo "<h4>Agregá</h4>";
									}
					echo "</ul>";
								?>

		    </section>
	</main>
	<br><br><br>

	
<?php include("includes\pie.php"); ?>
	
