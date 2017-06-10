$(document).ready(function(){
	
	$("#nombre").focus();

	$("#confirmaPassword").on('blur', function(){
		if ( $("#password").val() != $("#confirmaPassword").val() && $("#confirmaPassword").val()!="" ) {
			bootbox.alert("Las contrase&ntilde;as deben coincidir.", function(){
				$("#confirmaPassword").val("");
				$("#confirmaPassword").focus();
			});
		}
	});

	$("#mail").blur(function(){
		validarUnicoValor($(this));
	});

});

function validarUnicoValor( input ) {
	if ( input.val()!="" ) {
		var campo = input.attr("name");
		var valor = input.val();

		$.ajax({
			url : "logica/validar_unico_valor_usuario.php",
			type : "POST",
			data : "campo="+campo+"&valor="+valor,
			success : function( exists ) {
				if ( exists == 'true' ) {
					bootbox.alert("Ya existe una cuenta para <strong>"+valor+"</strong>.", function(){
						input.val("");
						input.focus();
					});
				}
			}
		});
	}
}