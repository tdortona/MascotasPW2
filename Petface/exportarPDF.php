<?php
session_start();
?>
<?php

//require_once 'lib/pdf/dompdf_config.inc.php';
use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;
require_once '/dompdf/autoload.inc.php';

$sexo = $_POST['sexo'] == "H" ? "Hembra" : "Macho";

$html='
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Perfil de Mascota: '.$_POST['nombreMascota'].'</title>
	<link rel="icon" href="img/petface_icon.ico"/>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/jquery-ui.min.css">
	<link rel="stylesheet" href="css/jquery-ui.theme.min.css">
	<link rel="stylesheet" href="css/petface.min.css">
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light" rel="stylesheet">
	<script src="js/angular.min.js"></script> 
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-ui.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootbox.min.js"></script>
	<script src="js/petface.js"></script>
</head>
<body>
	<h1>Perfil de Mascota:</h1>
	<p><b>Nombre:</b> '.$_POST['nombreMascota'].'</p>
	<p><b>Dueño:</b> '.$_POST['owner'].'</p>
	<p><b>Especie:</b> '.$_POST['especie'].'</p>
	<p><b>Raza:</b> '.$_POST['raza'].'</p>
	<p><b>Sexo:</b> '.$sexo.'</p>
	<p><b>Fecha de nacimiento:</b> '.$_POST['fnac'].'</p>
	<div class="well">
		<p>
		<div class="imagen">
			<img src="'.$_POST['fotoMascota'].'" class="img-circle" style="position:absolute; left: 400px; top: 40px;">
		</div>
		</p>
		<img src="'.$_POST['fotoUsuario'].'" class="img-circle" height="70" width="70" alt="Avatar" style="position:absolute; left: 500px; top:160px;">
	</div>
</body>
</html>';

$pdf = new DOMPDF();

# Definimos el tamaño y orientación del papel que queremos.
$pdf ->set_paper("A4", "portrait");

# Cargamos el contenido HTML.
$pdf ->load_html(html_entity_decode(htmlentities($html)));

# Renderizamos el documento PDF.
$pdf ->render();

# Enviamos el fichero PDF al navegador.
$pdf ->stream('Perfil de Mascota');
?>