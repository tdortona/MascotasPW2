<?php include("includes\\noCookie.php"); ?>
<?php include("includes\cabecera.php"); ?>
<?php include("includes\datosUsuario.php"); ?>
<?php include("includes\\navbar.php"); ?>
<script src="js/petface.registro.js"></script>
<!--?php include("includes\\navbar.php"); ?-->

<!--br><br><h2 class="text-center">Registro de mascota</h2-->
		
		<div class="jumbotron image-bg" >
			<div class="container">
				<img src="img/logo_nav_blanco.png" alt="PetFace" class="col-xs-12 col-sm-4 col-sm-offset-4">
			</div>
		</div>
		<div class="container">
			<div class="col-sm-12">
				<h2 class="text-center">Registro de Mascota</h2>
				<form action="logica\confirm_mascota.php" method="POST" id="registro-form" enctype="multipart/form-data">
					<div class="col-sm-6">
						<div class="form-group">
							<label for="nombre">Nombre</label>
							
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre y Apellido" required="required" <?php if (isset($_SESSION["nombre"]) and $_SESSION["nombre"]!='') {echo 'value="'.$_SESSION["nombre"].'"'; $_SESSION["nombre"]='';} ?> >
						</div>
						<div class="form-group">
							<label for="fechaNacimiento">Fecha de nacimiento</label>
							<input type="text" class="form-control birthdate" id="fechaNacimiento" name="fechaNacimiento" placeholder="Fecha de nacimiento" required="required" <?php if (isset($_SESSION["fechaNacimiento"]) and $_SESSION["fechaNacimiento"]!='') {echo 'value="'.$_SESSION["fechaNacimiento"].'"'; $_SESSION["fechaNacimiento"]='';} ?> >
						</div>
						<label for="imagenMascota">Imagen</label>
							<br>
							<input type="file" class="form-control" id="imagen" name="imagen" placeholder="Imagen" required="required" <?php if (isset($_SESSION["imagen"]) and $_SESSION["imagen"]!='') {echo 'value="'.$_SESSION["imagen"].'"'; $_SESSION["imagen"]='';} ?> >
							
                	</div> 
                	<div class="col-sm-6">
						<div class="form-group">
							<div ng-app="myapp" ng-controller="usercontroller" ng-init="load_tipo()" class="form-group">  
			                     <label for="tipo">Tipo</label>
			                     <select id="tipo" name="tipo" ng-model="tipo" class="form-control" ng-change="load_raza()">  
			                          <option value="">elija un tipo</option>  
			                          <option ng-repeat="tipo in tipos" value="{{tipo.id}}">{{tipo.tipo}}</option>  
			                     </select>  
		                    
	                    	
		                    	<label for="tipo">Raza</label>
			                     <select id="raza" name="raza" ng-model="raza" class="form-control" class="form-group">  
			                          <option value="" selected="selected" >elija una raza</option>  
			                          <option ng-repeat="raza in razas" value="{{raza.id}}">{{raza.raza}}</option>  
			                     </select>  
							</div>
							</br>
							<label for="sexo">Sexo</label>
							</br>
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
	</div>
</main>
</body>
</html>	
