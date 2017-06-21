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
<!-- CUERPO -->

	<section id="main-content" >
		<div class="container">


			<a class="btn btn-default" href="mensaje.php" id="btn-volver">
		      <span class="glyphicon glyphicon-circle-arrow-left"></span>
		      Volver a Mensajes
		    </a>

		    <div class="row">
		    	<div class="col-xs-12 col-sm-6 col-md-8">
			<?php
				//se crea el objeto de base de datos que contiene la conexion y el metodo de ejecucion de querys
				$database = new BaseDeDatos();

				$mensajeId = $_GET["id"];
				//se recupera el mail del usuario guardado en la cookie
				$mail = $_COOKIE["mail"];

				$queryVerMensaje = "SELECT mensaje.mensaje as mensaje, mensaje.id as mensajeId, usuario.id as usuarioId, remitente.imagen as remitenteImagen , remitente.nombre as remitente FROM mensaje INNER JOIN usuario ON 
						usuario.id = mensaje.idUsuario LEFT JOIN usuario remitente on remitente.id = mensaje.idRemitente WHERE usuario.mail= '$mail' and mensaje.id = '$mensajeId'";

						$resultado = $database->ejecutarQuery($queryVerMensaje) ; 
						if ($resultado->num_rows>0)  
							{
								while($row = $resultado->fetch_assoc())  
							    {
									if ($row["remitente"]!=NULL)
									{
										echo '<h2>Mensaje de: </br><img src="logica/'.$row["remitenteImagen"].'" class="img-circle" height="30" width="30" alt="Avatar"> '.$row["remitente"].'</h2>';
									}
									else
									{
										echo '<h2><img src="logica/Imagen Usuario/anonimo.jpg" class="img-circle" height="30" width="30" alt="Avatar">Anónimo</h2>';
									}
									echo '<pre style="white-space: normal; font-size:20px;" >';
									echo $row["mensaje"];
									echo '</pre>';

								}
							}
						else{
							header("location:../mensaje.php");
						}

			?>
				</div>
			</div>
		</br>
			<form action="logica/delete_mensaje.php" method="POST"> 
				<input type="hidden" name="mensajeId" value="<?php echo $mensajeId; ?>">
				<button class="btn btn-danger" id="btn-volver" type="submit">
			      <span class="glyphicon glyphicon glyphicon-trash"></span>
			      Eliminar
			    </button>

			</form>

		</div>
	</section>