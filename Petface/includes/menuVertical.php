<!-- MENU VERTICAL --> 
		

		<main>
				<div class="navbar navbar-inverse navbar-fixed-left text-center" id="menu-vertical">
				<?php
				
				if (basename($_SERVER['PHP_SELF'])!='home.php')
				{
					echo'
						<a class="btn btn-default" href="home.php" id="btn-volver">
					      <span class="glyphicon glyphicon-circle-arrow-left"></span>
					      Inicio
					    </a>';
				}
				?>
				  <!-- MENSAJES -->
 
                <?php
                $database = new BaseDeDatos();
                $queryVerMensajes = "SELECT * FROM usuario WHERE mail= '$mail'";
                $resultado =  $database->ejecutarQuery($queryVerMensajes) ;
 
                if ($resultado->num_rows>0)  
                {
                    while($row = $resultado->fetch_assoc())  
                    {
                        if ($row["mensaje"] == 1)
                        {
                            echo '<a class="btn btn-success" href="mensaje.php" style="position: relative; left:30px;">
                              <span class="glyphicon glyphicon-envelope"></span>
                              Mensajes
                                 </a>';
                        }
                        else {
                            echo '<a class="btn btn-default" href="mensaje.php" style="position: relative; left:30px;">
                              <span class="glyphicon glyphicon-envelope"></span>
                              Mensajes
                                 </a>';
                        }
                    }           
                } 
                else{
                    echo '<a class="btn btn-default" href="mensaje.php">
                              <span class="glyphicon glyphicon-envelope"></span>
                              Mensajes
                                 </a>';
                }   
                
                ?>
 
                <!-- ----------- -->
				</br>
					<div class="well">
						<p>
				    		<a class="navbar-brand" href="home.php" ><?php echo $nombreUsuario; ?></a>
				    	</p>
					</div>
				</br>
					<div class="imagen">
						<p>
							<div class="well">
					    		<img src="logica/<?php echo $imagenUsuario ?>" class="img-circle">
							</div>
						</p>
					</div>

				    <ul class="nav navbar-nav opciones">
				    		<li class="dropdown">
					    		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					    			Mascotas <span class="caret"></span>
					    		</a>
						       <ul class="dropdown-menu dropup" role="menu" aria-labelledby="dLabel">
										
									<?php

										$database = new BaseDeDatos();
										$queryVerMascotas = "SELECT mascota.nombre as nombre, mascota.id as id FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id where usuario.mail= '$mail' "; 
										$resultado =  $database->ejecutarQuery($queryVerMascotas) ;

											if ($resultado->num_rows>0)  
											{
												while($row = $resultado->fetch_assoc())  
											    {	
											 		echo "<li>";
												    echo 	'<a href="' . htmlspecialchars("/Petface/perfilMascota.php?nombreMascota=" .$row["id"]) . '">'."\n";
													echo 	"<h4>".$row["nombre"]."</h4> </a>";
													echo "</li>" ;
												}
											}
											else
											{
												?>
													<form action="mascotas_registro.php" method="get" enctype="multipart/form-data">

														<input type="submit" class="btn btn-primary" value="Registrar Mascota"></input>
														
													</form>
												<?php
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
				    	 <li><a href="amigos.php">Mascotas que sigo</a></li>
					     <li><a href="misMascotaEnAdopcion.php">Adopción</a></li>
					     <li><a href="#">Solos & Solas</a></li>
					     <li><a href="#">Cachorros</a></li>
					     <li><a href="#">Mascotas Perdidas</a></li>
				    
				    </ul>
				    <hr>
				</div>

		<!-- fin MENU VERTICAL --> 