<!-- verifica si no esta seteada una cookie, si no lo esta no permite entrar a esta pagina, devuelve al index -->
<?php include("includes\\noCookie.php"); ?>
<!-- setea variables con los valores del usuario para usarlos en la pagina usando la cookie que contiene su mail-->
<?php include("includes\datosUsuario.php"); ?>
<!-- cebezera con hojas de estilo y scripts -->
<?php include("includes\cabecera.php"); ?>
<!-- barra de navegacion -->
<?php include("includes\\navbar.php"); ?>
<!-- menu lateral del usuario -->
<?php include("includes\menuVertical.php"); ?>
<!-- las clases del objeto base de datos y usuario -->
<?php
  include_once("logica/clases/BaseDeDatos.php");
  include_once("logica/clases/Usuario.php");
?>

	<section id="main-content" >
		<div class="container">
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


	
	                                	<h3><?php echo"Mascota: ".$row["nombreMascota"].""; ?></h3>
	                                	<h3><?php echo "Dueño: ".$row["nombreUsuario"].""; ?></h3>
	                                	<h3><?php echo "Tipo: ".$row["tipo"].""; ?></h3>
	                                	<h3><?php echo "Raza: ".$row["raza"].""; ?></h3>
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
	</section>
		<!-- Encontré a tu mascota -->


		                	
		         
	
	
<?php include("includes\pie.php"); ?>