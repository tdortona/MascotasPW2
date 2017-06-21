<form action="logica\confirm_publicacion.php" method="POST" enctype="multipart/form-data">    
			      <div class="col-sm-10" >
			        <div class="panel panel-default"  >
			          <div class="panel-heading" style="background-image: linear-gradient(90deg, #309971, #2d2d2d); color: white; font-size: 20px;">
			          	<strong>Publicación</strong> 
			          </div>
			            <div class="panel-body">
			              <div class="input-group image-preview">
			                
			              </div>
			              
			              <!-- Comentarios -->
			              <textarea class="form-control" rows="2" placeholder="¡Comentario acá..!" id="texto" name="texto" required="required"></textarea>
			              <input type="hidden" name="idMascota" value="<?php /*id de la mascota definida en el include datosMascota.php*/ echo $idMascota; ?>">
			              <br />
			              <div class="form-group botones">
			                <button class="btn btn-default boton btn-lg" type="submit">
			                    
			                    Enviar
			                </button>
							<label class="btn btn-default btn-file">
						    	<span class="glyphicon glyphicon-camera"></span>
						    	Imagen 
						    	<input type="file" style="display: none;" id="pathImagen" name="pathImagen">
							</label>

			                <label class="btn btn-default btn-file">
	    						<span class="glyphicon glyphicon-facetime-video"></span>
	    						Video
	    						<input type="file" style="display: none;" id="pathVideo" name="pathVideo">
							</label>
			            </div>
			          </div>
			        </div>
			      </div>