<!-- se encarga de ver si esta seteada la cookie con el mail del usuario, si lo esta, no permite entrar a esta pagina, devuelve al home -->
<?php include("includes\cookie.php"); ?>
<!-- cebezera con hojas de estilo y scripts -->
<?php include("includes\cabecera.php"); ?>
<!-- php que devuelven los valores del nombre y el mail recientemente registrados -->
<?php 
	//comienza sesion
	session_start();
	//recupera el valor del nombre del usuario y lo pone en la variable nombre
	$nombre=$_SESSION["nombre"];
	//recupera el valor del mail del usuario y lo pone en la variable mail 
	$mail=$_SESSION["mail"];
?>
</head>
<body>
	<div class="row full-height image-bg">
		<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
			<div class="login-form">
				<img src="img/logo.png" alt="PetFace" class="img img-responsive">
				<br>
				<form action="index.php" method="POST">
					<div class="form-group">
						<label for="text">Felicidades, bienvenido <b style="color: green;"><?php/*nombre del usaurio*/ echo $nombre; ?></b> a PetFace, verifica tu cuenta revisando el mail que hemos mandado a tu correo <b style="color: green;"><?php /*mail del usaurio*/echo $mail; ?></b>
						</label>
					</div>
					<input type="submit" class="btn btn-primary btn-block" value="volver"></input>
				</form>
				<br>
			</div>
		</div>
	</div>

<?php include("includes\pie.php"); ?>