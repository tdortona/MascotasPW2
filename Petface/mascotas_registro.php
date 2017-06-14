<?php include("includes\\noCookie.php"); ?>
<?php include("includes\cabecera.php"); ?>
<?php include("includes\datosUsuario.php"); ?>
<?php include("includes\\navbar.php"); ?>
<?php include("includes\menuVertical.php"); ?>
<script src="js/petface.registro.js"></script>
<!--?php include("includes\\navbar.php"); ?-->

<!--br><br><h2 class="text-center">Registro de mascota</h2-->
		
		<section id="main-content" >
			<div class="container">
				<div class="col-sm-12">
					<h2>Registro de Mascota</h2>
					<form action="logica\confirm_mascota.php" method="POST" id="registro-form" enctype="multipart/form-data">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="nombre">Nombre</label>
								<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required="required" <?php if (isset($_SESSION["nombre"]) and $_SESSION["nombre"]!='') {echo 'value="'.$_SESSION["nombre"].'"'; $_SESSION["nombre"]='';} ?> >
							</div>
							<div class="form-group">
								<label for="fechaNacimiento">Fecha de nacimiento</label>
								<input type="text" class="form-control birthdate" id="fechaNacimiento" name="fechaNacimiento" placeholder="Fecha de nacimiento" required="required" <?php if (isset($_SESSION["fechaNacimiento"]) and $_SESSION["fechaNacimiento"]!='') {echo 'value="'.$_SESSION["fechaNacimiento"].'"'; $_SESSION["fechaNacimiento"]='';} ?> >
							</div>
							<div class="form-group">
								<label for="imagenMascota">Imagen</label>
								<br>
								<input type="file" class="form-control" id="imagen" name="imagen" placeholder="Imagen" required="required" <?php if (isset($_SESSION["imagen"]) and $_SESSION["imagen"]!='') {echo 'value="'.$_SESSION["imagen"].'"'; $_SESSION["imagen"]='';} ?> >
							</div>
							<div ng-app="myapp" ng-controller="usercontroller" ng-init="load_tipo()" class="form-group">  
								<div class="form-group">
									 <label for="tipo">Especie</label>
									 <select id="tipo" name="tipo" ng-model="tipo" class="form-control" ng-change="load_raza()">  
										  <option value="">- Elija una especie -</option>  
										  <option ng-repeat="tipo in tipos" value="{{tipo.id}}">{{tipo.tipo}}</option>  
									 </select>
								</div>
								<div class="form-group">
									<label for="tipo">Raza</label>
										 <select id="raza" name="raza" ng-model="raza" class="form-control" class="form-group">  
											  <option value="" selected="selected" >- Elija una raza -</option>  
											  <option ng-repeat="raza in razas" value="{{raza.id}}">{{raza.raza}}</option>  
										 </select>  
								</div>
							</div>
							<div class="form-group">
								<label for="sexo">Sexo</label>
								<label class="radio-inline">
									<input type="radio" name="sexo" class="sexo" value="M" <?php if ( !isset($_SESSION["sexo"]) or $_SESSION["sexo"]=='' or $_SESSION["sexo"]=='M') {echo 'checked="checked"'; $_SESSION["sexo"]='';} ?> >Macho
								</label>
								<label class="radio-inline">
									<input type="radio" name="sexo" class="sexo" value="H" <?php if (isset($_SESSION["sexo"]) and $_SESSION["sexo"]=='H') {echo 'checked="checked"'; $_SESSION["sexo"]='';} ?> >Hembra
								</label>
							</div>
						</div>
						<div class="col-sm-12">
							</br>
							<a href="perfilMascota.php" class="btn btn-danger">Cancelar</a>
							<input type="submit" class="btn btn-success" id="btnConfirmar" value="Confirmar"></input>
						</div>
					</form>
			</div>
		</section>
	</div>
</main>
</body>
</html>	
