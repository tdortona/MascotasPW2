<?php include("includes\\noCookie.php"); ?>
<?php include("includes\datosUsuario.php"); ?>

<?php include("includes\cabecera.php"); ?>
<?php include("includes\\navbar.php"); ?>

	<main>
		<div class="container">
			<ul class="list-unstyled list-thumbs row">
				<?php
				$mail = $_COOKIE["mail"];
				$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
				$sql= "SELECT mascota.id as id, mascota.nombre as nombre, mascota.imagen as imagen, tipo.tipo as tipo, raza.raza as raza, mascota.fechaNacimiento as fechaNacimiento, mascota.sexo as sexo FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id INNER JOIN tipo ON mascota.idTipo=tipo.id INNER JOIN raza ON mascota.idRaza=raza.id where usuario.mail= '$mail' ";
				$result = mysqli_query($conexion,$sql);
				if (mysqli_num_rows($result)>0) 
				{
					
					while($row = mysqli_fetch_assoc($result)) 
				    {
						/*$idDueño=$row["id"];*/
						echo "<li class='col-lg-3 col-sm-4 col-xs-6'>";
						echo '<a>'."\n";
						echo " <h2>".$row["nombre"]."</h2><br> ";
						?> <img src="logica/<?php echo $row['imagen']; ?>" class="img-responsive" height="130px">
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
				<input type="submit" class="btn btn-primary" value="ir al perfil"></input>
				
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