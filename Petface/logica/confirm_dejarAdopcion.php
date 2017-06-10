
<?php
echo $_GET["nombreMascota"];
@$enviar=$_POST["enviar"];

if (isset($_POST['enviar'])) {

@$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");

$sql= "UPDATE mascota set idEstado = '1' WHERE nombre='".$_GET["nombreMascota"]."' ";
        $result=mysqli_query($conexion,$sql) or die("no se agrego la fila");
        header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit;
} 		
else {

echo "No se puede añadir";

}


?>