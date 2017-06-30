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
	<h1>Ranking de mascotas</h1>
	<div id="piechart"></div>
	<div id="donutchart"></div>
	<div id="columnchart"></div>
</section>

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
	var options = {'title':'Top 3: Mascotas con mas likes', 'width':400, 'height':300, is3D: true};
	var chart = new google.visualization.PieChart(document.getElementById('piechart'));
	chart.draw(data, options);

	var jsonDataComent = $.ajax({
	  url: "logica/getDataByComentario.php",
	  dataType: "json",
	  async: false
	}).responseText;
	  
	// Create our data table out of JSON data loaded from server.
	var dataComent = new google.visualization.DataTable(jsonDataComent);

	// Instantiate and draw our chart, passing in some options.
	var optionsComent = {
		'title':'Top 3: Mascotas con mas comentarios',
		pieHole: 0.4,
		pieSliceTextStyle: {
            color: 'black'
          }
	};
	var chartComent = new google.visualization.PieChart(document.getElementById('donutchart'));
	chartComent.draw(dataComent, optionsComent);
	
	var jsonDataAmigos = $.ajax({
		url: "logica/getDataCantAmigos.php",
		dataType: "json",
		async: false
	}).responseText;
	
	var dataAmigos = google.visualization.arrayToDataTable($.parseJSON(jsonDataAmigos));
	var view = new google.visualization.DataView(dataAmigos);
	view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" }]);

	var optionsCol = {
		title: "Top 3: Mascotas con mas seguidores",
		width: 600,
		height: 400,
		bar: {groupWidth: "95%"},
		legend: { position: "none" },
	};
	var chartCol = new google.visualization.ColumnChart(document.getElementById("columnchart"));
	chartCol.draw(view, optionsCol);
}

</script>

<?php include("includes\pie.php"); ?>