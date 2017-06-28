<?php include("includes\cookie.php"); ?>
<?php include("includes\cabecera.php"); ?>

		<link rel="stylesheet" href="css/style.css" type="text/css">
    
	 <script src="js/petface.registro.js"></script>
	 


</head>
<body>
	<div class="row">
		<div class="jumbotron image-bg">
			<div class="container">
				<img src="img/logo_nav_blanco.png" alt="PetFace" class="col-xs-12 col-sm-4 col-sm-offset-4">
			</div>
		</div>
		<div class="container">
			<div class="col-xs-12">
			<?php 
					session_start();
					if (isset($_SESSION["errorTipo"]) and $_SESSION["errorTipo"]!='')
					{
						switch ($_SESSION["errorTipo"]) {
							case 'contraseña':
								echo "<h4 class=\"text-center\">Las contraseñas no coincide, asegurese de que sean iguales</h4> \n";
								break;
							case 'mail':
								echo "<h4 class=\"text-center\">Ya existe un usuario con ese mail, intente con otro</h4> \n";
								break;
							
							default:
								echo "<h4 class=\"text-center\">Ha ocurrido un error, vuelva a intentarlo</h4> \n";
								break;
						}
						
						$_SESSION["errorTipo"]='';
					}


				?>
				<h2 class="text-center">Registro de usuario</h2>
				<form action="logica\confirm.php" method="POST" id="registro-form" enctype="multipart/form-data">
					<div class="col-sm-6">
						
						<div class="form-group">

						<div class="form-group">
							<label for="mail">E-Mail</label>
							<input type="email" class="form-control" id="mail" name="mail" placeholder="E-Mail" required="required">
						</div>
						<div class="form-group">
							<label for="password">Contrase&ntilde;a</label>
							<input type="password" class="form-control" id="password" name="password" placeholder="Contrase&ntilde;a" required="required">
						</div>
						<div class="form-group">
							<label for="confirmaPassword">Confirme contrase&ntilde;a</label>
							<input type="password" class="form-control" id="confirmaPassword" name="confirmaPassword" placeholder="Confirme contrase&ntilde;a" required="required">

							

						</div>

						<label>Ubicacion (busque su posicion y haga clic en el mapa) </label>
						<div class="form-inline">
						
				      <input class="form-control" id="address" type="textbox" placeholder="¿en donde estas?" >

				      	<input class="btn btn-default" for="address" id="submit" type="button" value="Buscar">
				      
				      </div>

				      <div id = "sample" style = "max-width:400px; min-width:200px; height:150px; border:solid 1px; "></div><br>
				      <span id="texto" name="texto">Haga clic en el mapa para verificar su direccion</span>


				      <input  type="hidden" name="ubicacion" id="ubicacion" placeholder="ubicacion"   required="required">
				      <input type="hidden" name="lat" id="lat" >
				      <input type="hidden" name="lng" id="lng" >
				      </div>
						
					</div>
					
					
					
					<div class="col-sm-6">
						<div class="form-group">
							<label for="nombre">Nombre y Apellido</label>
							<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre y Apellido" required="required" <?php if (isset($_SESSION["nombre"]) and $_SESSION["nombre"]!='') {echo 'value="'.$_SESSION["nombre"].'"'; $_SESSION["nombre"]='';} ?> >
						</div>
						<div class="form-group">
							<label for="telefono">Tel&eacute;fono</label>
							<input type="text" class="form-control" id="telefono" name="telefono" placeholder="Tel&eacute;fono" required="required" <?php if (isset($_SESSION["telefono"]) and $_SESSION["telefono"]!='') {echo 'value="'.$_SESSION["telefono"].'"'; $_SESSION["telefono"]='';} ?> >
						</div>
						<div class="form-group">
							<label for="fechaNacimiento">Fecha de nacimiento</label>
							<input type="text" class="form-control birthdate" id="fechaNacimiento" name="fechaNacimiento" placeholder="Fecha de nacimiento" required="required" <?php if (isset($_SESSION["fechaNacimiento"]) and $_SESSION["fechaNacimiento"]!='') {echo 'value="'.$_SESSION["fechaNacimiento"].'"'; $_SESSION["fechaNacimiento"]='';} ?> >
						</div>
						
						<div class="form-group">	
							<label for="imagen">Imagen</label>
							<input type="file" class="form-control" id="imagen" name="imagen" placeholder="Imagen" required="required" <?php if (isset($_SESSION["imagen"]) and $_SESSION["imagen"]!='') {echo 'value="'.$_SESSION["imagen"].'"'; $_SESSION["imagen"]='';} ?> >
						</div>

						
						<div class="form-group">
							<label for="sexo">Sexo</label>
							<br>
							<label class="radio-inline">
								<input type="radio" name="sexo" class="sexo" value="M" <?php if ( !isset($_SESSION["sexo"]) or $_SESSION["sexo"]=='' or $_SESSION["sexo"]=='M') {echo 'checked="checked"'; $_SESSION["sexo"]='';} ?> >Mujer
							</label>
							<label class="radio-inline">
								<input type="radio" name="sexo" class="sexo" value="F" <?php if (isset($_SESSION["sexo"]) and $_SESSION["sexo"]=='F') {echo 'checked="checked"'; $_SESSION["sexo"]='';} ?> >Hombre
							</label>
						</div>
						<div class="col-sm-12">
							<a href="index.php" class="btn btn-danger">Cancelar</a>
							<input type="submit" class="btn btn-success" id="btnConfirmar" value="Confirmar"></input>
						</div>
						
					</div>
					
					
					
					

				</form>
			</div>
		</div>
	</div>

			
	<br><br><br>
<?php include("includes\pie.php"); ?>
<script>
        function loadMap() 
        {
          
          document.getElementById("lat").value="";
          document.getElementById("lng").value="";

          var mapOptions = 
          {
            center:new google.maps.LatLng(-34.603712, -58.381549), 
            zoom:16, 
            mapTypeId:google.maps.MapTypeId.ROADMAP,
            streetViewControl:false
          };

          var map = new google.maps.Map(document.getElementById("sample"),mapOptions);

          var geocoder = new google.maps.Geocoder();

          document.getElementById('submit').addEventListener('click', function() {
            geocodeAddress(geocoder, map);
          });

          google.maps.event.addListener(map, 'click', function(event) {
            geocoder.geocode({'latLng': event.latLng}, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) 
              {
                var lat = event.latLng.lat();

                document.getElementById("lat").value=lat;

                var lng = event.latLng.lng();

                document.getElementById("lng").value=lng;

                document.getElementById("ubicacion").value=results[0].formatted_address;
                document.getElementById("texto").textContent=results[0].formatted_address;

               /* for (var i = 0; i < results[0].address_components.length; i++)
                {
                  var addr = results[0].address_components[i];

                  if (addr.types[0] == "administrative_area_level_1")
                  {
                    var provincia = addr.long_name;
                    document.getElementById("provincia").value=addr.long_name; 
                  }

                  if (addr.types[0] == "country")
                  {
                    var pais = addr.long_name;
                    document.getElementById("pais").value=addr.long_name;  
                  }       
                }*/ 
              }
              else 
              {
                alert('Geocode was not successful for the following reason: ' + status);
              }
            });
          });

          function geocodeAddress(geocoder, resultsMap) 
          {
            var address = document.getElementById('address').value;

            geocoder.geocode({'address': address}, function(results, status) {
              if (status === 'OK') 
              {
                resultsMap.setCenter(results[0].geometry.location);

                var marker = new google.maps.Marker({
                  map: resultsMap,
                  animation: google.maps.Animation.Drop,
                  position: results[0].geometry.location,
                  zoom:18
                });
              } 
              else 
              {
                alert('Geocode was not successful for the following reason: ' + status);
              }
            });
          }

        }

        google.maps.event.addDomListener(window, 'load', loadMap);
        </script>