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

					</br>
					<?php
					 	//se recupera el mail del usuario guardado en la cookie
						$mail = $_COOKIE["mail"];
						//se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
						$database = new BaseDeDatos();

						//select para ver todas las mascotas del usuario activo recuperando de la tabla de de mascota anidada con la tabla usaurio (el idUsuario de mascota con el id de usuario), anidada con la tabla raza (el idRaza de mascota con id de raza) y anidada con la tabla tipo (el idTipo de mascota con el id de tipo) los campos id, nombre, imagen fechaNacimiento, sexo de mascota, la raza de raza y el tipo de tipo usando el mail del usuario actual guardado en la cookie en el where
						$queryMascotasDelUsuarioActivo= "SELECT mascota.nombre as nombreMascota, mascota.idEstado as estado, mascota.id as idMascota, mascota.busqueda_pareja as busqueda_pareja  FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id INNER JOIN tipo ON mascota.idTipo=tipo.id INNER JOIN raza ON mascota.idRaza=raza.id where usuario.mail= '$mail' ";

						//resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
						$resultado =  $database->ejecutarQuery($queryMascotasDelUsuarioActivo) ;

						//verifica si encuentra resultados en la query para ver las mascotas del usuario, si no entra en el else
						if ($resultado->num_rows>0) 
						{	
							echo "<form action='citas.php' method='GET'> ";
							echo "	<select id='mascotaId' name='mascotaId'>";
							echo "<option  value=''>--- Elige una mascota ---</option>";
							
							//empieza a recorrer los registros
							while($row = $resultado->fetch_assoc())  
						    {	
						    	if ($row['estado'] != 4 and $row['estado'] != 2)
								//a lo largo de los echos va usando los resultados de los campos del registro actual
								{
									echo "<option  value='".$row["idMascota"]."'>";
									echo	$row["nombreMascota"] ;
									echo "</option>";
								}
							}	
							echo "	</select>";

							echo " <button type='submit' >Buscar</button>";

							echo "</form>";
						}
						else
						{
							echo "<h4>Aún no tiene mascotas!</h4>";
						}
					?>

				</br>
					</br>
				<!-- Mascotas en búsqueda de citas -->

					<?php


					if(isset($_GET["mascotaId"]))

					{
						$mascotaId=$_GET["mascotaId"];
						$queryDatosDeLaMascota="SELECT raza.id as razaId, tipo.id as tipoId FROM mascota INNER JOIN raza ON mascota.idRaza=raza.id INNER JOIN tipo ON mascota.idTipo=tipo.id WHERE mascota.id='$mascotaId'";
						$resultado=$database->ejecutarQuery($queryDatosDeLaMascota);

						if ($resultado->num_rows>0)
						{
							while ($fila= $resultado->fetch_assoc()) {
					
					$queryMisMascotasBusquedaCita= "SELECT mascota.nombre as nombreMascota, mascota.imagen as imagenMascota, mascota.idEstado as estado, mascota.id as idMascota, mascota.busqueda_pareja as busqueda_pareja FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id INNER JOIN tipo ON mascota.idTipo=tipo.id INNER JOIN raza ON mascota.idRaza=raza.id where tipo.id=".$fila["tipoId"]." and usuario.mail!='".$mail."'";
					//if (){$queryMisMascotasBusquedaCita=$queryMisMascotasBusquedaCita."and raza.id=".$fila["razaId"].""}

							//resultados: se llama al metodo que realiza la query en la base de datos OJO solo se genera una variable, no se realiza todavia el metodo
							$resultado2 =  $database->ejecutarQuery($queryMisMascotasBusquedaCita) ;

							//verifica si encuentra resultados en la query para ver las mascotas del usuario, si no entra en el else
							if ($resultado2->num_rows>=0) 
							{
								//empieza a recorrer los registros
								echo '<table class="table table-hover" style="cursor:hand">
								    	<thead>
								    		<td><h4>Mis mascotas en búsqueda de citas</h4></td>
								    	</thead>';

								while($row = $resultado2->fetch_assoc())  
							    {	
							    	if ($row['estado'] != 4 and $row['estado'] != 2 /*and $row['busqueda_pareja'] == 1*/)
									//a lo largo de los echos va usando los resultados de los campos del registro actual
									{
										

								    	echo '<tbody>';
								    		echo '<tr>';
								    		
								    		echo 	'<td><img src="logica/'.$row["imagenMascota"].'" class="img-circle" height="30" width="30" alt="Avatar"> '.$row["nombreMascota"];
								    		echo
									'<form action="perfilMascota.php" method="GET" enctype="multipart/form-data">
										<input type="hidden" name="nombreMascota" value="'.$row["idMascota"].'">
										<br>
										<input type="submit" class="btn btn-primary" value="Ir al perfil"></input>
									</form>'." ";
								    		echo'</td>';
								    		
								    		
								    		/*echo '<td>'.substr($row["mensaje"], 0, 50).'...</td>';*/
									        
									      
											echo '</tr>';
										echo '</tbody>';
	  							
									}
								}

								echo '</table>';   
							}
							else
							{
								echo "<h4>Aún no tiene mascotas!</h4>";
							}
						}
					}
					}
					?>
		</section>
	</main>
	
<!-- pie de pagina -->
<?php include("includes\pie.php"); ?>
