function meGusta(idPublicacion, idUsuario, idMascota){
	$("#noMeGusta"+idPublicacion+"").hide();
	$("#meGusta"+idPublicacion+"").removeClass("btn-primary boton");
	$("#meGusta"+idPublicacion+"").addClass("btn-success");
	$("#meGusta"+idPublicacion+"").prop('disabled', true);
	mostrarTextAreaDeComentario(idPublicacion, idUsuario, idMascota);
	$.ajax({
	  type: "POST",
	  url: "logica/publicacionLike.php",
	  data: {
			idPublicacion: idPublicacion,
			idUsuario: idUsuario,
			like: 1,
			comentario: "",
			idMascota: idMascota
		}
	});
}

function noMeGusta(idPublicacion, idUsuario, idMascota){
	$("#meGusta"+idPublicacion+"").hide();
	$("#noMeGusta"+idPublicacion+"").removeClass("btn-primary boton");
	$("#noMeGusta"+idPublicacion+"").addClass("btn-danger");
	$("#noMeGusta"+idPublicacion+"").prop('disabled', true);
	mostrarTextAreaDeComentario(idPublicacion, idUsuario, idMascota);
	$.ajax({
	  type: "POST",
	  url: "logica/publicacionLike.php",
	  data: {
			idPublicacion: idPublicacion,
			idUsuario: idUsuario,
			like: 0,
			comentario: "",
			idMascota: idMascota
		}
	});
}

function mostrarTextAreaDeComentario(idPublicacion, idUsuario, idMascota){
	$("#publicacion"+idPublicacion+"").after("<textarea id='comentario"+idPublicacion+"' rows='4' cols='50' maxlength='200'></textarea><br>");
	$("#comentario"+idPublicacion+"").after("<br><input id='btnComentar"+idPublicacion+"' class='btn btn-primary boton' type='button' value='Guardar Comentario' onclick='guardarComentario("+idPublicacion+","+idUsuario+","+idMascota+")'>");
}

function guardarComentario(idPublicacion, idUsuario, idMascota){
	$("#btnComentar"+idPublicacion+"").hide();
	$("#comentario"+idPublicacion+"").prop('readonly', true);
	$.ajax({
	  type: "POST",
	  url: "logica/guardarComentario.php",
	  data: {
			idPublicacion: idPublicacion,
			idUsuario: idUsuario,			
			comentario: $("#comentario"+idPublicacion+"").val(),
			idMascota: idMascota
		}
	});
}