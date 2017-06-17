<?php include("includes\cookie.php"); ?>
<?php include("includes\cabecera.php"); ?>
	<?php require_once("login-facebook.php"); ?>

</head>
<body>
	<div class="row full-height image-bg">
		<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
			<div class="login-form">
				<img src="img/logo_nav.png" alt="PetFace" class="img img-responsive">
				<br>
				<?php 
					// session_start();
					if (isset($_SESSION["noIngreso"]) and $_SESSION["noIngreso"]==1)
					{
						echo "<p>El E-mail o contraseña son incorrectos. Por favor, re-ingreselos</p>";
						$_SESSION["noIngreso"]=0;
					}
				?>
				<form action="logica\login.php" method="POST">
					<div class="form-group">
						<label for="mail">E-Mail</label>
						<input type="email" class="form-control" id="mail" name="mail" placeholder="E-Mail" required="required">
					</div>
					<div class="form-group">
						<label for="password">Contraseña</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required="required">
					</div>

					<input type="submit" class="btn btn-primary btn-block" value="Ingresar"></input>
				</form>
				<br>
				<p class="text-center">¿No tienes cuenta? Registrate haciendo <a href="registro.php">click aquí.</a></p>
				<br>
				<p>
					<?php /* Link a la página de login*/
						echo '<a href="' . htmlspecialchars($loginUrl) . '">Login con Facebook!</a>';
					?>
				</p>
			</div>
		</div>
	</div>

<?php include("includes\pie.php"); ?>