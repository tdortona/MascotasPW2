<!-- las clases del objeto base de datos y usuario -->
<?php
  include_once("clases/BaseDeDatos.php");
  include_once("clases/Usuario.php");
?>

<?php
$id=$_GET["id"];
$idMascota=$_GET["idMascota"];
$database = new BaseDeDatos();
$mail = $_COOKIE["mail"];
//posiciona la fecha y hora de argentina
date_default_timezone_set('America/Argentina/Buenos_Aires');
$fecha=date('Y-m-d H:i:s');

if ($id!="1" and $id!="2" and $id!="3" and $id!="4")
{
	header("location:../home.php");
}

$queryMascotaYdueño="select * from mascota inner join usuario on mascota.idUsuario=usuario.id where usuario.mail='$mail' and mascota.id='$idMascota'";

$resultado =  $database->ejecutarQuery($queryMascotaYdueño) ;

if ($resultado->num_rows>0)
{
	
}
else
{
	header("location:../home.php");
}

//verifica si no esta seteada una cookie, si no lo esta no permite entrar a esta pagina, devuelve al index
include("includes\\noCookie.php");
//setea variables con los valores del usuario para usarlos en la pagina usando la cookie que contiene su mail
include("includes\datosUsuario.php");
//cebezera con hojas de estilo y scripts
include("includes\cabecera.php");
//barra de navegacion
include("includes\\navbar.php");
//menu lateral del usuario
include("includes\menuVertical.php");

?>

<?php

$id=$_GET["id"];

switch ($id) {
    case "1":
        
        /*Cambio el estado de la mascota (estado 1)*/
		$queryCambioDeEstado="UPDATE mascota set idEstado = '1' WHERE id='$idMascota' ";
		$database->ejecutarQuery($queryCambioDeEstado) ;

		/*Inserto el nuevo estado de la mascota en la table historial_estado*/
		$queryHistorialDeEstado="INSERT INTO historial_estado VALUES ('','$idMascota', '1', '$fecha')";
		$database->ejecutarQuery($queryHistorialDeEstado) ;

		header("location:../perfilMascota.php?nombreMascota=$idMascota");
        break;
    case "2":
        
        /*Cambio el estado de la mascota (estado 2)*/
		$queryCambioDeEstado="UPDATE mascota set idEstado = '2' WHERE id='$idMascota' ";
		$database->ejecutarQuery($queryCambioDeEstado) ;

		/*Inserto el nuevo estado de la mascota en la table historial_estado*/
		$queryHistorialDeEstado="INSERT INTO historial_estado VALUES ('','$idMascota', '2', '$fecha')";
		$database->ejecutarQuery($queryHistorialDeEstado) ;

		header("location:../perfilMascota.php?nombreMascota=$idMascota");
        break;
    case "3":
        
        /*Cambio el estado de la mascota (estado 3)*/
		$queryCambioDeEstado="UPDATE mascota set idEstado = '3' WHERE id='$idMascota' ";
		$database->ejecutarQuery($queryCambioDeEstado) ;

		/*Inserto el nuevo estado de la mascota en la table historial_estado*/
		$queryHistorialDeEstado="INSERT INTO historial_estado VALUES ('','$idMascota', '3', '$fecha')";
		$database->ejecutarQuery($queryHistorialDeEstado) ;

		header("location:../perfilMascota.php?nombreMascota=$idMascota");
        break;
    case "4":
        
        /*Cambio el estado de la mascota (estado 4)*/
		$queryCambioDeEstado="UPDATE mascota set idEstado = '4' WHERE id='$idMascota' ";
		$database->ejecutarQuery($queryCambioDeEstado) ;

		/*Inserto el nuevo estado de la mascota en la table historial_estado*/
		$queryHistorialDeEstado="INSERT INTO historial_estado VALUES ('','$idMascota', '4', '$fecha')";
		$database->ejecutarQuery($queryHistorialDeEstado) ;

		header("location:../perfilMascota.php?nombreMascota=$idMascota");
        break;
    default:
        
        break;
}

?>