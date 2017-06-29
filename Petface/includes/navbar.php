<?php
	
	setcookie("mail",$mail,time()+1728000,"/");
?>
<nav class="navbar navbar-default navbar-fixed-top" style="background-image: linear-gradient(90deg, #309971, #2d2d2d); color: white; font-size: 20px;">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="home.php" class="navbar-brand">
				<img src="img/logo_nav_blanco.png" style="width: 100px; margin-top: -4px;">
			</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav navbar-right">
				<li>
					<form class="navbar-form navbar-right" role="search">
			        <div class="form-group input-group">
			          <input type="text" class="form-control" placeholder="Buscar..">
			          <span class="input-group-btn">
			            <button class="btn btn-default" type="button">
			              <span class="glyphicon glyphicon-search"></span>
			            </button>
			          </span>        
			        </div>
			      </form>
      			</li>
				<li><a href="home.php">Inicio</a></li>
				<li><a href="mascotas.php">Mis mascotas</a></li>
				<li><a href="valoraciones.php">Valoracion</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> <?php echo $nombreUsuario ?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Accion 1</a></li>
						<li><a href="#">Configuración</a></li>
						<li role="separator" class="divider"></li>
						<li><a href="./logica/logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>