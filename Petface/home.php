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
				    			<form method="get" action="perfilMascota.php">
									<div ng-app="myapp" ng-controller="usercontroller" ng-init="load_mascota()" class="form-group">  
				                     
				                     <select id="mascota" name="nombreMascota" ng-model="mascota" class="form-control" onchange='if(this.value != 0) { this.form.submit(); }'>  
				                          <option value="0">elija una mascota</option>  
				                          <option ng-repeat="mascota in mascotas" value="{{mascota.id}}">{{mascota.nombre}}</option>  
				                     </select>  
									</div>
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
			   

			      <!--?php
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
								?-->
			    

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
	
