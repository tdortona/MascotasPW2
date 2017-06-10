
<?php

@$enviar=$_POST["enviar"];
@$nombreMascota=$_POST["nombreMascota"];

if (isset($_POST['enviar'])) {

@$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");


$sql= "UPDATE mascota set idEstado = '1' WHERE nombre='pipo' ";
        $result=mysqli_query($conexion,$sql) or die("no se agrego la fila");
        session_start();
}
else {

echo "No se puede añadir";

}


?>