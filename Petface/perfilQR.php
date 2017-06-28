

<?php include("includes\cabecera.php"); ?>
<?php
  include_once("logica/clases/BaseDeDatos.php");
  include_once("logica/clases/Usuario.php");
?>

	<main>
		<?php
			
			$database = new BaseDeDatos();
			$queryVerMascotas = 
			"SELECT mascota.nombre as nombreMascota, mascota.id as id, mascota.imagen as imagen, tipo.tipo as tipo, raza.raza as raza,
			usuario.nombre as nombreUsuario, usuario.telefono as telefono, usuario.mail as mail
			FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id INNER JOIN tipo ON mascota.idTipo=tipo.id INNER JOIN raza ON mascota.idRaza=raza.id 
			where  mascota.id = '".$_GET["idMascota"]."' "; 
			$resultado =  $database->ejecutarQuery($queryVerMascotas) ;

			if ($resultado->num_rows>=0) 
			{
				
				while($row = $resultado->fetch_assoc())  
		   		{	$mail=$row["mail"];
				
		?>


		<div class="container">
	    <div class="row">
	        <div class="col-lg-offset-3 col-lg-6">
	            <div class="panel panel-default">
	                <div class="panel-body">
	                    <div class="row">
	                        <div class="col-lg-12">
	                            <div class="row">
	                                <div class="col-sm-offset-3 col-sm-6 col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6">
	                                    <?php echo "<img class='img-circle img-responsive' src='logica/".$row["imagen"]."'>"; ?>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row">
	                        <div class="col-lg-12">
	                            <div class="row">
	                                <ul class="centered-text">
	                                	<li><h3><?php echo"Mascota: ".$row["nombreMascota"].""; ?></h3></li>
	                                	<li><h3><?php echo "Dueño: ".$row["nombreUsuario"].""; ?></h3></li>
	                                	<li><h3><?php echo "Tipo: ".$row["tipo"].""; ?></h3></li>
	                                	<li><h3><?php echo "Raza: ".$row["raza"].""; ?></h3></li>
	                                </ul>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="panel-footer">
	                    <div class="row">
	                        <div id="social-links" class="col-lg-12">
	                            <div class="row">
	                                <div class="col-sm-3 social-btn-holder">
	                                    <!--button type="button" class="btn btn-primary">
	                                    	<span class="glyphicon glyphicon-heart" aria-hidden="true"></span> Seguir
	                                    </button-->
	                                    <?php 
										     @$database = new BaseDeDatos();
										     @$mail = $_COOKIE["mail"];
										     $idMascota = $_GET["idMascota"];

										     $queryEsMiMascotaONo="select mascota.id as id from mascota inner join usuario on mascota.idUsuario=usuario.id where usuario.mail='$mail' and mascota.id='$idMascota'";

										    $resultado =  $database->ejecutarQuery($queryEsMiMascotaONo) ;

											if ($resultado->num_rows>0)
										    {	
										    		include("includes\seguirPerfilQR.php"); 
										    
											}
											else
											{
												echo'
												<form action="index.php" method="POST">
									            	<input type="submit" class="btn btn-primary" value="Seguir">
									                </input>
									            </form>';
											}
										?>
	                                </div>
	                                <div class="col-sm-6 social-btn-holder">
	                                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#qr_view"><i class="fa fa-search">Encontré a tu mascota</button>
	                                </div>
	                                <div class="col-sm-3 social-btn-holder">
	                                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#qr_view"><i class="fa fa-search"> Citas</button>
	                                    	<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
	                                	</button>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

</main>
		<!-- Encontré a tu mascota -->

		<div class="modal fade qr_view" id="qr_view">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <a href="#" data-dismiss="modal" class="class pull-right"><span class="glyphicon glyphicon-remove"></span></a>
		           		<?php echo "<h3 class='modal-title'>Contactar con el dueño de ".$row["nombreMascota"]." </h3>" ?>
		            </div>
		            <div class="modal-body">
		                 
		                <div class="col-md-12">

		                	<form method="post" action="logica\confirm_mensaje.php">
						        <?php
				                    echo "<h2>".$row["nombreUsuario"]."</h2>";
				                    echo "<h4>Llamar al número: <span>".$row["telefono"]."</span></h4>";
				                    
				                    
					                    echo "<div class='form-group'>";
										echo "  <h4>Enviar mensaje al dueño:</h4>";
										echo "</br>  <textarea class='form-control' rows='5' id='Mensaje' name='Mensaje' placeholder='¡Escriba aquí!'></textarea>";

										$database = new BaseDeDatos();
										 

										 $queryUsuario="select * from usuario where mail='".$mail."' ";

										$resultado =  $database->ejecutarQuery($queryUsuario) ;

										if ($resultado->num_rows>0)

										{
											while ($row = $resultado->fetch_assoc()) 
											{
												$idUsuario=$row["id"];
											}
										
										}
										echo "  <input type='hidden' name='idUsuario' id='idUsuario' value='".$idUsuario."'>";
										echo "  <input type='hidden' name='mailUsuario' id='mailUsuario' value='".$mail."'>";
										echo "</div>";

					                 	echo "</div>";
					                    echo "<div class='space-ten'></div>";
					                    /*echo "<a href='mailto:".$row["mail"]."' type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-envelope'></span> Enviar</a>";*/

							            echo "<button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon-envelope'></span> Enviar</button>";
						            
									}
										}
								?>

							</form>

		                </div>
		            </div>
		        </div>
		    </div>
		</div>


			
	<br><br><br>
	
<?php include("includes\pie.php"); ?>