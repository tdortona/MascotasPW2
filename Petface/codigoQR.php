<!-- verifica si no esta seteada una cookie, si no lo esta no permite entrar a esta pagina, devuelve al index -->
<?php include("includes\\noCookie.php"); ?>
<!-- setea variables con los valores del usuario para usarlos en la pagina usando la cookie que contiene su mail -->
<?php include("includes\datosUsuario.php"); ?>
<!-- cebezera con hojas de estilo y scripts -->
<?php include("includes\cabecera.php"); ?>
<!-- barra de navegacion -->
<?php include("includes\\navbar.php"); ?>
<!-- menu lateral del usuario -->
<?php include("includes\menuVertical.php"); ?>
<?php
	// las clases del objeto base de datos y usuario 
	include_once("logica/clases/BaseDeDatos.php");
	include_once("logica/clases/Usuario.php");
?>
<div class="container">

<?php

$idMascota=$_GET['idMascota'];
$nombreMascota=$_GET['nombreMascota'];

include("logica/qr/Conectarbd.php");
include("logica/qr/phpqrcode/qrlib.php");

$qrTemporal='logica/qr/imagenes';
//$qrPath=$qrTemporal.'/'.uniqid();
$qrPath=$qrTemporal.'/'.'mascota='.$idMascota.'nombre='.$nombreMascota.'.png';


QRcode::png('localhost/Petface/perfilQR.php?idMascota='.$idMascota.'&nombreMascota='.$nombreMascota,$qrPath,QR_ECLEVEL_L,8);

$qrImagen=file_get_contents($qrPath);


//unlink($qrPath);

?>

<!--<img src="data:image/png;base64,<?php //echo base64_encode($qrImagen) ?>" /> -->
<h3>Código QR de <b><?php echo $nombreMascota; ?></b></h3>

<img src="<?php echo $qrPath; ?>" />

<p>Éste es el código QR de <b><?php echo $nombreMascota; ?></b><br>Para guardarlo puede hacer lo siguiente:<br>1-Click secundario (por lo general el botón derecho) sobre el código QR<br>2-Click sobre "Guardar imagen como..."<br>3-Elegir la carpeta donde se guardará la imagen y si desea puede cambiarle el nombre<br>5-Edite e imprima la imagen con su programa preferido</p>

<form action="perfilMascota.php" method="GET" enctype="multipart/form-data">
										<input type="hidden" name="nombreMascota" value="<?php echo $idMascota; ?>">
										<br>
										<input type="submit" class="btn btn-primary" value="Volver al perfil"></input>
									</form>

</div>