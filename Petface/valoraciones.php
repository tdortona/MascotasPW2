<?php include("includes\\noCookie.php"); ?>
<?php include("includes\datosUsuario.php"); ?>
<?php include("includes\cabecera.php"); ?>
<?php include("includes\\navbar.php"); ?>
<?php include("includes\menuVertical.php"); ?>
<?php
  include_once("logica/clases/BaseDeDatos.php");
  include_once("logica/clases/Usuario.php");
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<section id="main-content" >
	<h1>My Web Page</h1>
	<div id="piechart"></div>
</section>
<?php 
	$database = new BaseDeDatos();
	$querySumLikes= "SELECT `mascota`.`nombre` as nombreMascota,
							SUM(`likepublicacion`.`like`) as likeCount,
					FROM `likepublicacion`
					INNER JOIN `mascota`
					ON `likepublicacion`.`idMascota` = `mascota`.`id`
					GROUP BY `likepublicacion`.`idMascota`";
	$resultado =  $database->ejecutarQuery($querySumLikes);
?>
<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
      var jsonData = $.ajax({
          url: "logica/getData.php",
          dataType: "json",
          async: false
          }).responseText;
          
      // Create our data table out of JSON data loaded from server.
      var data = new google.visualization.DataTable(jsonData);

      // Instantiate and draw our chart, passing in some options.
	  var options = {'title':'Top 3: Mascotas con mas likes', 'width':400, 'height':300};
      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);
}
</script>
<?php include("includes\pie.php"); ?>