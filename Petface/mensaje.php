
<!--verifica si no esta seteada una cookie, si no lo esta no permite entrar a esta pagina, devuelve al index -->
<?php include("includes\\noCookie.php"); ?>
<!-- setea variables con los valores del usuario para usarlos en la pagina usando la cookie que contiene su mail-->
<?php include("includes\datosUsuario.php"); ?>
<!-- cebezera con hojas de estilo y scripts -->
<?php include("includes\cabecera.php"); ?>
	

		  

<?php

//se recupera el mail del usuario guardado en la cookie
				$mail = $_COOKIE["mail"];
				//se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
				$database = new BaseDeDatos();
				//update para cambiar el estado del mensaje a 0 (ya esta visto)
				$queryCambiarEstadoMensajes = "UPDATE usuario SET mensaje = 0 WHERE mail= '$mail'";
				$database->ejecutarQuery($queryCambiarEstadoMensajes) ;

				


?>
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
			  <h2>Mensajes</h2>
			          
			  
			    	<?php
						$queryVerMensajes = "SELECT mensaje.mensaje as mensaje, mensaje.id as mensajeId, usuario.id as usuarioId, remitente.imagen as remitenteImagen , remitente.nombre as remitente,
						mensaje.fechaMensaje as fechaMensaje FROM mensaje INNER JOIN usuario ON 
						usuario.id = mensaje.idUsuario LEFT JOIN usuario remitente on remitente.id = mensaje.idRemitente WHERE usuario.mail= '$mail' ORDER BY mensaje.fechaMensaje DESC"; 
							$resultado = $database->ejecutarQuery($queryVerMensajes) ; 

							if ($resultado->num_rows>0)  
							{
								echo '<table class="table table-hover" style="cursor:hand">
							    <thead>
							      <tr>
							        
							        <th>Enviado por</th>
							        <th>Mensaje</th>
							        <th>Fecha y Hora</th>
							      </tr>
							    </thead>
							    <tbody>';
								while($row = $resultado->fetch_assoc())  
							    {
							    	
									echo '<tr onclick="window.location.href=\'verMensaje.php?id='.$row["mensajeId"].'\'";>';
									if ($row["remitente"]!=NULL)
									{
										echo '<td><img src="logica/'.$row["remitenteImagen"].'" class="img-circle" height="30" width="30" alt="Avatar"> '.$row["remitente"].'</td>';
									}
									else
									{
										echo '<td><img src="logica/Imagen Usuario/anonimo.jpg" class="img-circle" height="30" width="30" alt="Avatar">Anónimo</td>';

									}

							        echo '<td>'.substr($row["mensaje"], 0, 50).'...</td>';
							        echo '<td>'.$row["fechaMensaje"].'</td>';
							      
									echo'</tr>';
								 	
								}	 
 								
								echo' </tbody>
			  					</table>';     	
							}
							else {
								echo "<h4>Aún no tiene Mensajes</h4>";
							}
					?>
			   
			</div>
	</section>