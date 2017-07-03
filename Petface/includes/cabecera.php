<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>PetFace - TP PWII</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/jquery-ui.min.css">
		<link rel="stylesheet" href="css/jquery-ui.theme.min.css">
		<link rel="stylesheet" href="css/petface.min.css">
		<link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light" rel="stylesheet">

		<script src="js/angular.min.js"></script> 
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/bootbox.min.js"></script>
		<script src="js/petface.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyApylwApXXXOCpr3LNzp2cXVougcQxqZq4&callback=loadMap"></script>
    
		<script>  
 var app = angular.module("myapp",[]);  
 app.controller("usercontroller", function($scope, $http){  
      $scope.load_tipo = function(){  
           $http.get("logica\\load_tipo.php")  
           .success(function(data){ 
           $scope.raza = $scope.option=""; 
                $scope.tipos = data;
                  
           })  
      }  
      $scope.load_raza = function(){  
           $http.post("logica\\load_raza.php", {'id':$scope.tipo})  
           .success(function(data){ 
                $scope.raza = $scope.option="";
                $scope.razas = data;
                
           });  
      }

	<link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light" rel="stylesheet">



$(function(){
$('#estado_cambio').on('change',function(){
  var idm = $('#idm').val();
  var url=$(this).val();
  if (url!=""){
    window.location='cambiarEstado.php?id='+url+'&idm='+idm;
  }
  return false;
});
});


/* PONER EN ADOPCIÓN */

				})  
			}  
			$scope.load_raza = function(){  
				$http.post("logica\\load_raza.php", {'id':$scope.tipo})  
				.success(function(data){ 
					$scope.raza = $scope.option="";
					$scope.razas = data;

				});  
			}

    $('#enviar').change(function() {
  // Enviamos el formulario usando AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            // Mostramos un mensaje con la respuesta de PHP
            success: function(data) {
                $('#resultado').html(data);
            }
        })        
        return false;
    });
})  
 
 
 </script>