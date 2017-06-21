<!-- se encarga de ver si esta seteada la cookie con el mail del usuario, si lo esta, no permite entrar a esta pagina, devuelve al home -->
<?php include("includes\cookie.php"); ?>
<!-- cebezera con hojas de estilo y scripts -->
<?php include("includes\cabecera.php"); ?>
</head>
<body>
	<?php 
		//comienza sesion
		session_start();
		//recupera en valor que fallo en el formulario
		$error=$_SESSION["error"];
		//recupera el parametro que fallo
		$errorTipo=$_SESSION["errorTipo"];
	?>
	<div class="row imageBg">
		<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
			<div class="loginForm">
				<img src="img/logo.png" alt="PetFace" class="img img-responsive">
				<br>
				<!-- form que regresa al registro -->
				<form action="registro.php" method="POST">
					<div class="form-group">
						<!-- dentro del text area se muestra el valor almacenado en $error y $error tipo -->
						<label for="text">Lo sentimos, el <?php echo $errorTipo ?> <b style="color: green;"><?php echo $error; ?></b> ya existe, pruebe con otro
						</label>
					</div>
					<input type="submit" class="btn btn-primary btn-block" value="volver"></input>
				</form>
				<br>
			</div>
		</div>
	</div>
<!-- pie de pagina -->
<?php include("includes\pie.php"); ?>
