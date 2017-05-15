<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>PetFace - TP PWII</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/petface.min.css">
</head>
<body>
	<div class="row loginBg">
		<div class="col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
			<div class="loginForm">
				<img src="img/logo.png" alt="PetFace" class="img img-responsive">
				<br>
				<form action="" method="POST">
					<div class="form-group">
						<label for="mail">E-Mail</label>
						<input type="email" class="form-control" id="mail" placeholder="E-Mail">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" id="password" placeholder="Password">
					</div>

					<input type="submit" class="btn btn-primary btn-block" value="Ingresar"></input>
				</form>
				<br>
				<p class="text-center">¿No tienes cuenta? Registrate haciendo <a href="#">click aquí.</a></p>
			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>