<?php include("includes\cookie.php"); ?>
<?php include("includes\cabecera.php"); ?>
</head>
<body>
	<?php 
		session_start();
		$error=$_SESSION["error"];
		$errorTipo=$_SESSION["errorTipo"];
	?>
	<div class="row imageBg">
		<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
			<div class="loginForm">
				<img src="img/logo.png" alt="PetFace" class="img img-responsive">
				<br>
				<form action="registro.php" method="POST">
					<div class="form-group">
						<label for="text">Lo sentimos, el <?php echo $errorTipo ?> <b style="color: green;"><?php echo $error; ?></b> ya existe, pruebe con otro
						</label>
					</div>
					<input type="submit" class="btn btn-primary btn-block" value="volver"></input>
				</form>
				<br>
			</div>
		</div>
	</div>

<?php include("includes\pie.php"); ?>
