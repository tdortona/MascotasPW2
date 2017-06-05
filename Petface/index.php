<!-- se encarga de ver si esta seteada la cookie con el mail del usuario, si lo esta, no permite entrar a esta pagina, devuelve al home -->
<?php include("includes\cookie.php"); ?>
<!-- cebezera con hojas de estilo y scripts -->
<?php include("includes\cabecera.php"); ?>
</head>
<body>
	<div class="row full-height image-bg">
		<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
			<div class="login-form">
				<img src="img/logo_nav.png" alt="PetFace" class="img img-responsive">
				<br>
				<!-- php que verifica si se intento ingresar a la cuenta y el login fallo, de ser asi devuelve el mensaje de que algo fallo-->
				<?php 
					//inicio de sesion
					session_start();
					//verifica si la la variable de sesion "noIngreso" esta seteada y tiene por valor 1, si tiene ambas cosas, muestra el mensaje de que fallo el ingreso
					if (isset($_SESSION["noIngreso"]) and $_SESSION["noIngreso"]==1)
					{
						//muestra mensaje
						echo "<p>El E-mail o contraseña son incorrectos. Por favor, re-ingreselos</p>";
						//vuelve a setear la variable de sesion "noIngreso" a 0, para que si refresca la pagina no vuelva a aparecer el mismo mensaje
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
			</div>
		</div>
	</div>
	
<!-- pie de pagina -->
<?php include("includes\pie.php"); ?>