<!-- verifica si no esta seteada una cookie, si no lo esta no permite entrar a esta pagina, devuelve al index -->
<?php include("includes\\noCookie.php"); ?>
<!-- setea variables con los valores del usuario para usarlos en la pagina usando la cookie que contiene su mail -->
<?php include("includes\datosUsuario.php"); ?>
<!-- cebezera con hojas de estilo y scripts -->
<?php include("includes\cabecera.php"); ?>
<!-- barra de navegacion -->
<?php include("includes\\navbar.php"); ?>
<!-- menu lateral del usuario -->
<?php include("includes\menuVertical.php"); ?>

<?php
	// las clases del objeto base de datos y usuario 
	include_once("logica/clases/BaseDeDatos.php");
	include_once("logica/clases/Usuario.php");
?>

		<section id="main-content" >
		<!-- redirige al registro de mascota -->
			<form action="mascotas_registro.php" method="get" enctype="multipart/form-data">
				<input type="submit" class="btn btn-success" value="Registrar Mascota"></input>
			</form>
			<br>
			<ul class="list-unstyled list-thumbs row">
				<?php
					//se recupera el mail del usuario guardado en la cookie
					$mail = $_COOKIE["mail"];

					//se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
					$database = new BaseDeDatos();

					//select para ver todas las mascotas del usuario activo recuperando de la tabla de de mascota anidada con la tabla usaurio (el idUsuario de mascota con el id de usuario), anidada con la tabla raza (el idRaza de mascota con id de raza) y anidada con la tabla tipo (el idTipo de mascota con el id de tipo) los campos id, nombre, imagen fechaNacimiento, sexo de mascota, la raza de raza y el tipo de tipo usando el mail del usuario actual guardado en la cookie en el where
					$queryMascotasDelUsuarioActivo= "SELECT mascota.id as id, mascota.nombre as nombre, mascota.imagen as imagen, tipo.tipo as tipo, raza.raza as raza, mascota.fechaNacimiento as fechaNacimiento, mascota.edad as edad, mascota.sexo as sexo FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id INNER JOIN tipo ON mascota.idTipo=tipo.id INNER JOIN raza ON mascota.idRaza=raza.id where usuario.mail= '$mail' ";

					//resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
					$resultado =  $database->ejecutarQuery($queryMascotasDelUsuarioActivo) ;

					//verifica si encuentra resultados en la query para ver las mascotas del usuario, si no entra en el else
					if ($resultado->num_rows>=0) 
					{
						//empieza a recorrer los registros
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
									</form>'." ";
								echo "</a> \n";
							echo "</li> \n";
						}
					}
					else
					{
						echo "<h4>Aún no agregó sus mascotas, agregue la primera!</h4>";
					}
				?>
			</ul>
			
			
		</section>
	</main>

<!-- pie de pagina -->	
<?php include("includes\pie.php"); ?>