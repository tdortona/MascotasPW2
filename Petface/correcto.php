<?php include("includes\cookie.php"); ?>
<?php include("includes\cabecera.php"); ?>
<?php 
	session_start();
	$nombre=$_SESSION["nombre"];
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
						<label for="text">Felicidades, bienvenido <b style="color: green;"><?php echo $nombre; ?></b> a PetFace, verifica tu cuenta revisando el mail que hemos mandado a tu correo <b style="color: green;"><?php echo $mail; ?></b>
						</label>
					</div>
					<input type="submit" class="btn btn-primary btn-block" value="volver"></input>
				</form>
				<br>
			</div>
		</div>
	</div>
<?php unset($_SESSION["nombre"]); unset($_SESSION["mail"]); ?>
<?php include("includes\pie.php"); ?>