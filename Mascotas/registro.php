<?php include("includes\cookie.php"); ?>
<?php include("includes\cabecera.php"); ?>
</head>
<body>
	<div class="row imageBg">
		<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
			<div class="loginForm">
				<img src="img/logo.png" alt="PetFace" class="img img-responsive">
				<br>
				<form action="logica\confirm.php" method="POST">
					<div class="form-group">
						<label for="text">Ingrese su usuario</label>
						<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required="required">
					</div>
					<div class="form-group">
						<label for="password">Ingrese su contraseña</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required="required">
					</div>
					<div class="form-group">
						<label for="text">Ingrese su nombre</label>
						<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required="required">
					</div>
					<div class="form-group">
						<label for="mail">Ingrese un e-mail</label>
						<input type="email" class="form-control" id="mail" name="mail" placeholder="E-Mail" required="required">
					</div>
					

					<input type="submit" class="btn btn-primary btn-block" value="Registrar"></input>
				</form>
				<br>
				<form action="index.php" method="POST">
					<input type="submit" class="btn btn-primary btn-block" value="Volver"></input>
				</form>
				<br>
			</div>
		</div>
	</div>

<?php include("includes\pie.php"); ?>