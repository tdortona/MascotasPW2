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

});