<?php include("includes\\noCookie.php"); ?>
<?php include("includes\datosUsuario.php"); ?>
<?php include("includes\cabecera.php"); ?>
<?php include("includes\\navbar.php"); ?>
<?php include("includes\menuVertical.php"); ?>
<?php
  include_once("logica/clases/BaseDeDatos.php");
  include_once("logica/clases/Usuario.php");
?>

<section id="main-content" >
	<ul class="list-unstyled list-thumbs row">
		<h3>Mis mascotas perdidas: </h3>
	</br>
		<?php
			
		    $database = new BaseDeDatos();
		    $mail = $_COOKIE["mail"];

			$queryAdopcion2= "SELECT mascota.id as id, mascota.nombre as nombre, mascota.imagen as imagen, tipo.tipo as tipo, raza.raza as raza, mascota.fechaNacimiento as fechaNacimiento, mascota.edad as edad, mascota.sexo as sexo FROM mascota INNER JOIN usuario ON usuario.id = mascota.idUsuario INNER JOIN tipo ON mascota.idTipo=tipo.id INNER JOIN raza ON mascota.idRaza=raza.id where mascota.idEstado = '2' and usuario.mail='$mail'";
		    $resultado =  $database->ejecutarQuery($queryAdopcion2) ;

				if ($resultado->num_rows>0)  
				{
					while($row = $resultado->fetch_assoc())  
				    {	
				 		//a lo largo de los echos va usando los resultados de los campos del registro actual
							echo "<li class='col-lg-3 col-sm-4 col-xs-6'> \n";
								echo '<a>'."\n";
									echo " <h2 class='blanco'>".$row["nombre"]."</h2><br> \n";
									echo "<div class='img'> <img src='logica/".$row['imagen']."' class='img-responsive'> </div>  \n";
									echo "<br>";
									echo "<strong>Tipo:</strong> ".$row["tipo"]."<br>\n";
									echo "<strong>Raza:</strong> ".$row["raza"]."<br>\n";
									if ($row["sexo"]=="H")
									{
										echo "<strong>Sexo:</strong> Hembra<br>\n";
									}
									else
									{
										echo "<strong>Sexo:</strong> Macho<br>\n";
									}
									echo "<strong>Nació el:</strong> ".$row["fechaNacimiento"]."<br>\n";
									echo "<strong>Edad:</strong> ".$row["edad"]."<br>\n";
									echo
									'<form action="perfilMascota.php" method="GET" enctype="multipart/form-data">
										<input type="hidden" name="nombreMascota" value="'.$row["id"].'">
										<br>
										<input type="submit" class="btn btn-primary" value="Ir al perfil"></input>
									</form>'." \n";
								echo "</a> \n";
							echo "</li> \n";
					}
				}
				else
				{
					?>
						<span>No tiene mascotas en Adopción</span>
					<?php
				}
		?>
</section>