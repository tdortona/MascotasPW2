<?php include("includes\\noCookie.php"); ?>
<?php include("includes\datosUsuario.php"); ?>
<?php include("includes\cabecera.php"); ?>
<?php include("includes\\navbar.php"); ?>
<?php include("includes\menuVertical.php"); ?>
<?php
  include_once("logica/clases/BaseDeDatos.php");
  include_once("logica/clases/Usuario.php");
?>

<?php
	
	$database = new BaseDeDatos();
	$queryVerMascotas2 = 
	"SELECT mascota.nombre as nombre, mascota.id as id FROM mascota INNER JOIN usuario ON mascota.idUsuario=usuario.id 
	where usuario.mail= '$mail' and mascota.idEstado='3'"; 
	$resultado =  $database->ejecutarQuery($queryVerMascotas2) ;

		if ($resultado->num_rows>0)  
		{
			while($row = $resultado->fetch_assoc())  
		    {	
		 		echo "<li>";
				echo 	"<h4>".$row["nombre"]."</h4> </a>";
				echo "</li>" ;
			}
		}
		else
		{
			?>
				<span>No tiene mascotas en Adopción</span>
			<?php
		}
?>