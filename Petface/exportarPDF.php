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
</head>
<body>
<h1>Perfil de Mascota:</h1>
<p>Nombre: '.$_POST['nombreMascota'].'</p>
<p>Dueño: '.$_POST['owner'].'</p>
<p>Especie: '.$_POST['especie'].'</p>
<p>Raza: '.$_POST['raza'].'</p>
<p>Sexo: '.$sexo.'</p>
<p>Fecha de nacimiento: '.$_POST['fnac'].'</p>
</body>
</html>';

$pdf = new DOMPDF();

# Definimos el tamaño y orientación del papel que queremos.
$pdf ->set_paper("A4", "portrait");

# Cargamos el contenido HTML.
$pdf ->load_html(utf8_decode($html));

# Renderizamos el documento PDF.
$pdf ->render();

# Enviamos el fichero PDF al navegador.
$pdf ->stream('Perfil de Mascota');
?>