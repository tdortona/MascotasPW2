<!-- verifica si no esta seteada una cookie, si no lo esta no permite entrar a esta pagina, devuelve al index -->
<?php include("includes\\noCookie.php"); ?>
<!-- setea variables con los valores del usuario para usarlos en la pagina usando la cookie que contiene su mail -->
<?php include("includes\datosUsuario.php"); ?>
<!-- cebezera con hojas de estilo y scripts -->
<?php include("includes\cabecera.php"); ?>
<!-- barra de navegacion -->
<?php include("includes\\navbar.php"); ?>

	<main>
		<div class="container">
			<ul class="list-unstyled list-thumbs row">
				<?php
				//se recupera el mail del usuario guardado en la cookie
				$mail = $_COOKIE["mail"];
				//query de conexion
				$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
				//select para ver todas las mascotas del usuario activo recuperando de la tabla de de mascota anidada con la tabla usaurio (el idUsuario de mascota con el id de usuario), anidada con la tabla raza (el idRaza de mascota con id de raza) y anidada con la tabla tipo (el idTipo de mascota con el id de tipo) los campos id, nombre, imagen fechaNacimiento, sexo de mascota, la raza de raza y el tipo de tipo usando el mail del usuario actual guardado en la cookie en el where
				$sql= "SELECT mascota.id as id, mascota.nombre as nombre, mascota.imagen as imagen, tipo.tipo as tipo, raza.raza as raza, mascota.fechaNacimiento as fechaNacimiento, mascota.sexo as sexo FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id INNER JOIN tipo ON mascota.idTipo=tipo.id INNER JOIN raza ON mascota.idRaza=raza.id where usuario.mail= '$mail' ";
				//query del resultado
				$result = mysqli_query($conexion,$sql);
				//verifica si encuentra resultados en la query para ver las mascotas del usuario, si no entra en el else
				if (mysqli_num_rows($result)>0) 
				{
					//empieza a recorrer los registros
					while($row = mysqli_fetch_assoc($result)) 
				    {
						
						echo "<li class='col-lg-3 col-sm-4 col-xs-6'>";
						echo '<a>'."\n";
						//se muestra el nombre de la mascota
						echo " <h2>".$row["nombre"]."</h2><br> ";
						//se muestra la foto de perfil de la mascota
						?> <img src="logica/<?php echo $row['imagen']; ?>" class="img-responsive" height="130px">
						<?php
						//se muestra el tipo de la mascota
						echo "Tipo: ".$row["tipo"]."<br>\n";
						//se muestra la raza de la mascota
						echo "Raza: ".$row["raza"]."<br>\n";
						//se lee el sexo de la mascota, si es "H" es hembra y entra en el if, si no, es macho y entra en el else
						if ($row["sexo"]=="H")
						{
							echo "Sexo: Hembra<br>\n";
						}
						else
						{
							echo "Sexo: Macho<br>\n";
						}
						//se muestra la fecha de nacimiento de la mascota
						echo "Fecha de Nacimiento: ".$row["fechaNacimiento"]."<br>\n";
						//dentro del form para enviar al perfil de esa mascota, hay un input escondido que tiene el valor del id de la mascota, que lo pasa por get y en la pagina del perfil de la mascota lo recupera
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
			<!-- redirige al registro de mascota -->
			<form action="mascotas_registro.php" method="get" enctype="multipart/form-data">
				
				<input type="submit" class="btn btn-primary" value="Registrar Mascota"></input>
				
			</form>
		</div>
	</main>

<!-- pie de pagina -->
<?php include("includes\pie.php"); ?>