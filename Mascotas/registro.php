<?php include("includes\cookie.php"); ?>
<?php include("includes\cabecera.php"); ?>
	
	<script src="js/petface.registro.js"></script>
</head>
<body>
	<div class="row">
		<div class="jumbotron image-bg">
			<div class="container">
				<img src="img/logo_nav_blanco.png" alt="PetFace" class="col-xs-12 col-sm-4 col-sm-offset-4">
			</div>
		</div>
		<div class="container">
			<div class="col-xs-12">
				<h2 class="text-center">Registro de usuario</h2>
				<form action="logica\confirm.php" method="POST" id="registro-form">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="nombre">Nombre y Apellido</label>
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre y Apellido" required="required">
						</div>
						<div class="form-group">
							<label for="telefono">Tel&eacute;fono</label>
							<input type="text" class="form-control" id="telefono" name="telefono" placeholder="Tel&eacute;fono" required="required">
						</div>
						<div class="form-group">
							<label for="fechaNacimiento">Fecha de nacimiento</label>
							<input type="text" class="form-control birthdate" id="fechaNacimiento" name="fechaNacimiento" placeholder="Fecha de nacimiento" required="required">
						</div>
						<div class="form-group">
							<label for="sexo">Sexo</label>
							<br>
							<label class="radio-inline">
								<input type="radio" name="sexo" class="sexo" value="M" checked="checked">M
							</label>
							<label class="radio-inline">
								<input type="radio" name="sexo" class="sexo" value="F">F
							</label>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
							<label for="mail">E-Mail</label>
							<input type="email" class="form-control" id="mail" name="mail" placeholder="E-Mail" required="required">
						</div>
						<div class="form-group">
							<label for="password">Contrase&ntilde;a</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Contrase&ntilde;a" required="required">
						</div>
						<div class="form-group">
							<label for="confirmaPassword">Confirme contrase&ntilde;a</label>
							<input type="password" class="form-control" id="confirmaPassword" name="confirmaPassword" placeholder="Confirme contrase&ntilde;a" required="required">
						</div>
					</div>
					<div class="col-sm-12">
						<a href="javascript:history.back()" class="btn btn-danger">Cancelar</a>
						<input type="submit" class="btn btn-success" id="btnConfirmar" value="Confirmar"></input>
					</div>
				</form>
			</div>
		</div>
	</div>
	<br><br><br>
<?php include("includes\pie.php"); ?>