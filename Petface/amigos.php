<?php include("includes\\noCookie.php"); ?>
<?php include("includes\datosUsuario.php"); ?>
<?php include("includes\cabecera.php"); ?>
<?php include("includes\\navbar.php"); ?>


	<main>
		<div class="container">
			<ul class="list-unstyled list-thumbs row">
				<?php
				 	include_once("logica/clases/BaseDeDatos.php");
  					include_once("logica/clases/Usuario.php");
  					$database = new BaseDeDatos();
					$mail = $_COOKIE["mail"];
					
					$queryMascotasQueSigue= "SELECT mascota.nombre as nombreMascota, mascota.imagen as imagenMascota, mascota.id as id, tipo.tipo as tipo, raza.raza as raza, mascota.fechaNacimiento as fechaNacimiento, mascota.sexo as sexo FROM mascota INNER JOIN seguidor on mascota.id=seguidor.idMascota INNER JOIN usuario ON seguidor.idUsuario=usuario.id INNER JOIN tipo ON mascota.idTipo=tipo.id INNER JOIN raza ON mascota.idRaza=raza.id where usuario.mail='$mail' ";
					$resultado =  $database->ejecutarQuery($queryMascotasQueSigue) ;

					if ($resultado->num_rows>0)  
					{
						
						while($row = $resultado->fetch_assoc()) 
					    {
							
							echo "<li class='col-lg-3 col-sm-4 col-xs-6'>";
							echo '<a>'."\n";
							echo " <h2>".$row["nombreMascota"]."</h2><br> ";
							?> <img src="logica/<?php echo $row['imagenMascota']; ?>" class="img-responsive">
							<?php

							echo "Tipo: ".$row["tipo"]."<br>\n";
							echo "Raza: ".$row["raza"]."<br>\n";
							if ($row["sexo"]=="H")
							{
								echo "Sexo: Hembra<br>\n";
							}
							else
							{
								echo "Sexo: Macho<br>\n";
							}
							echo "Fecha de Nacimiento: ".$row["fechaNacimiento"]."<br>\n";

							echo
							'<form action="perfilMascota.php" method="GET" enctype="multipart/form-data">
								<input type="hidden" name="nombreMascota" value="'.$row["id"].'">
								<input type="submit" class="btn btn-primary" value="Ir al perfil"></input>
								
							</form>';
							echo "</a></li>";
						}
					}
				else
				{
					echo "<h4>Aún no sigues a ninguna mascota</h4>";
				}
				?>
			</ul>
		</div>
	</main>
	
<?php include("includes\pie.php"); ?>