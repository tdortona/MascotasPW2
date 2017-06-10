<?php include("includes\\noCookie.php"); ?>
<?php include("includes\datosUsuario.php"); ?>

<?php include("includes\cabecera.php"); ?>
<?php include("includes\\navbar.php"); ?>

<?php
  include_once("logica/clases/BaseDeDatos.php");
  include_once("logica/clases/Usuario.php");
?>

	<main>
		<div class="container">
			<ul class="list-unstyled list-thumbs row">
				<?php
				$database = new BaseDeDatos();
				$mail = $_COOKIE["mail"];
				
				$queryMascotasDelUsuarioActivo= "SELECT mascota.id as id, mascota.nombre as nombre, mascota.imagen as imagen, tipo.tipo as tipo, raza.raza as raza, mascota.fechaNacimiento as fechaNacimiento, mascota.sexo as sexo FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id INNER JOIN tipo ON mascota.idTipo=tipo.id INNER JOIN raza ON mascota.idRaza=raza.id where usuario.mail= '$mail' ";
				
				$resultado =  $database->ejecutarQuery($queryMascotasDelUsuarioActivo) ;

				if ($resultado->num_rows>=0) 
				{
					
					while($row = $resultado->fetch_assoc())  
				    {
						/*$idDueño=$row["id"];*/
						echo "<li class='col-lg-3 col-sm-4 col-xs-6'>";
						echo '<a>'."\n";
						echo " <h2>".$row["nombre"]."</h2><br> ";
						?> <img src="logica/<?php echo $row['imagen']; ?>" class="img-responsive">
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
					echo "<h4>Aún no agregó sus mascotas, agregue la primera!</h4>";
				}
				?>
			</ul>
			<form action="mascotas_registro.php" method="get" enctype="multipart/form-data">
				
				<input type="submit" class="btn btn-primary" value="Registrar Mascota"></input>
				
			</form>
		</div>
	</main>
	
<?php include("includes\pie.php"); ?>