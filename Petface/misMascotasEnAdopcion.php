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

	$queryAdopcion2= "SELECT * FROM mascota";
    $resultado =  $database->ejecutarQuery($queryAdopcion2) ;

		if ($resultado->num_rows>0) 
        {
		 		echo "<li>";
				echo 	"<h4>".$nombreMascota."</h4> </a>";
				echo "</li>" ;
				?><span>No tiene mascotas en Adopción</span> <?php
			
		}
		else
		{
			?>
				<span>No tiene mascotas en Adopción</span>
			<?php
		}
?>