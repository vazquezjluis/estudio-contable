<?php
	/*-------------------------
	Autor: Jose Luis Vazquez
	Web: www.control-app.com
	Mail: info@control-app.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
        header("location: login.php");
		exit;
        }
	
	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$active_facturas="";
	$active_productos="";
	$active_clientes="active";
	$active_usuarios="";	
	$title="Clientes | Estudio Contable";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	
	?>
	
	<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
				<button type='button' class="btn btn-success" data-toggle="modal" data-target="#nuevoCliente"><span class="glyphicon glyphicon-plus" ></span> Nuevo Cliente</button>
			</div>
			<h4></i> Clientes</h4>
		</div>
		<div class="panel-body">
				<?php
					include("modal/clientes/registro_clientes.php");
					include("modal/clientes/editar_clientes.php");
					include("modal/clientes/movimiento_cliente.php");
					include("modal/clientes/documentos.php");
					include("modal/clientes/mensaje.php");
				?>
				<form class="form-horizontal" role="form" id="datos_cotizacion">				
							<div class="form-group row">
								<div class="col-md-5">
									<input type="text" class="form-control" id="q" placeholder="Nombre del cliente" onkeyup='load(1);'>
								</div>
									<span id="loader"></span>
							</div>
				</form>

			</div>
			<div id="resultados"></div><!-- Carga los datos ajax -->
			<div class='outer_div'></div><!-- Carga los datos ajax -->
			
  
	</div>
		 
	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/clientes.js"></script>
  </body>
</html>
