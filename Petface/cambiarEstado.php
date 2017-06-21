<!-- las clases del objeto base de datos y usuario -->
<?php
  include_once("logica/clases/BaseDeDatos.php");
  include_once("logica/clases/Usuario.php");
?>
<?php
$nombreMascota=$_GET["nombreMascota"];
$id=$_GET["id"];
if ($id!="1" and $id!="2" and $id!="3" and $id!="4")
{
	header("location:home.php");
}
$database = new BaseDeDatos();
$mail = $_COOKIE["mail"];
$idMascota=$_GET["idm"];

$queryEsMiMascotaONo="select * from mascota inner join usuario on mascota.idUsuario=usuario.id where usuario.mail='$mail' and mascota.id='$idMascota'";

$resultado =  $database->ejecutarQuery($queryEsMiMascotaONo) ;

if ($resultado->num_rows>0)
{
	
}
else
{
	header("location:home.php");
}
?>
<!-- verifica si no esta seteada una cookie, si no lo esta no permite entrar a esta pagina, devuelve al index -->
<?php include("includes\\noCookie.php"); ?>
<!-- setea variables con los valores del usuario para usarlos en la pagina usando la cookie que contiene su mail-->
<?php include("includes\datosUsuario.php"); ?>
<!-- cebezera con hojas de estilo y scripts -->
<?php include("includes\cabecera.php"); ?>
<!-- barra de navegacion -->
<?php include("includes\\navbar.php"); ?>
<!-- menu lateral del usuario -->
<?php include("includes\menuVertical.php"); ?>

	<section id="main-content" >
<?php
$id=$_GET["id"];

switch ($id) {
    case "1":
        echo "<h4>¡Tu mascota está con vos! <br>¿Confirma el estado?</h4>";
        break;
    case "2":
        echo "<h4>¡Tu mascota está perdida!<span></span> <br>¿Confirma el estado?</h4>";
        break;
    case "3":
        echo "<h4>¡Tu mascota está en adopción! <br>¿Confirma el estado?</h4>";
        break;
    case "4":
        echo "<h4>¡Tu mascota está embarazada! <br>¿Confirma el estado?</h4>";
        break;
    default:
        
        break;
}
?>

</br>
<?php echo "<form action='logica/confirm_estado.php?id=".$id."&idMascota=".$idMascota."' method='POST'>" ?>;
    <button type='submit' class='btn btn-primary'><span class='glyphicon glyphicon glyphicon-ok'></span> Confirmar</button>
</form>
	</section>

