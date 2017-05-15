<!DOCTYPE html>
<html>
<head>
	<title>home</title>
</head>
<body>
	<h2>Registrarse</h2>
	<form method="post" action="registro.php">
		usuario: <input type="text" name="user"><br>
		password: <input type="password" name="clave"><br>
		<input type="submit" name="enviar" value="registrar">
	</form>
	<h2>Iniciar sesion</h2>
	<form method="post" action="inicio.php">
		usuario: <input type="text" name="user"><br>
		password: <input type="password" name="clave"><br>
		<input type="submit" name="enviar" value="iniciar">
	</form>
	<br>
	<form action="cuentas.php">
    	<input type="submit" value="ver todos los registros">
	</form> 
</body>
</html>