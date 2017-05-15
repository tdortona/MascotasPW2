<?php include("cabecera.php"); ?>

</head>
<body>
	<div class="row imageBg">
		<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
			<div class="loginForm">
				<img src="img/logo.png" alt="PetFace" class="img img-responsive">
				<br>
				<form action="" method="POST">
					<div class="form-group">
						<label for="mail">E-Mail</label>
						<input type="email" class="form-control" id="mail" placeholder="E-Mail" required="required">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" placeholder="Password" required="required">
					</div>

					<input type="submit" class="btn btn-primary btn-block" value="Ingresar"></input>
				</form>
				<br>
				<p class="text-center">¿No tienes cuenta? Registrate haciendo <a href="#">click aquí.</a></p>
			</div>
		</div>
	</div>

<?php include("pie.php"); ?>