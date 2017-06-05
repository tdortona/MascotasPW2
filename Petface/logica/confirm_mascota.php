<!-- php para registrar mascota -->

<?php
	//se setea una variable mail con el valor de de la cookie
	$mail = $_COOKIE["mail"];
	//query de conexion
	$conexion = mysqli_connect("localhost", "root", "", "petfacepw2") or die ("No se puede conectar con el servidor");
	//select para devolver el registro del usaurio activo usando la tabla usuario con la variable mail en el where 
	$sql= "SELECT * FROM usuario where mail= '$mail' ";
	//query resultado
	$result = mysqli_query($conexion,$sql);
	//se verifica los resultados
	if (mysqli_num_rows($result)>0) 
	{
		//se empieza a recorrer los (o mejor dicho el) resultados
		while($row = mysqli_fetch_assoc($result)) 
	    {
	    	//se encuentra el registro y se setea en una variable el valor del campo id
			$idDueño=$row["id"];
		}
	} 
	//setea todas las variables con los valores que se le paso por el post
	$nombre=$_POST["nombre"];	
	$tipo=$_POST["tipo"];
	$raza=$_POST["raza"];
	$sexo=$_POST["sexo"];
	$fechaRegistro=date('Y-m-d');
	@$imagen="Imagen Mascota";
	@$archivo=$_FILES['imagen']['tmp_name'];
	@$nombreArchivo=$_FILES['imagen']['name'];
	move_uploaded_file($archivo,$imagen."/".$nombreArchivo);
	@$imagen=$imagen."/".$nombreArchivo;	
	//se recupera la el valor de la fecha de nacimiento, se cambia las / por - para que coincida con la base de datos y por ultimo se cambia el orden de los numeros para que coincidan con la base de datos
	$fechaNacimiento=date('Y-m-d',strtotime( str_replace('/', '-', $_POST["fechaNacimiento"])));

	//insert para insertar la nueva mascota en la tabla mascotas con las variables definidas al principo
	$sql2= "INSERT INTO mascota VALUES ('','$idDueño','$nombre','$tipo','$raza','$sexo','$fechaNacimiento','','$imagen',1,'$fechaRegistro')";
	//query resultado
	$result=mysqli_query($conexion,$sql2) or die("no se agrego la fila");
		
	header("location:../home.php");
	
	$conexion->close();

?>

<?php echo "<a href=\"../registro.php\">volver</a>" ?>