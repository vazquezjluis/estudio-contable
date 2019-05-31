<?php
	/*-------------------------
	Autor: Jose Luis Vazquez
	Web: www.control-app.com
	Mail: info@control-app.com
	---------------------------*/
	session_start();
	if (!isset($_SESSION['cliente_login_status']) AND $_SESSION['cliente_login_status'] != 1) {
        header("location: ../login.php");
		exit;
        }

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

	$active_facturas="";
	$active_productos="";
	$active_clientes="active";
	$active_usuarios="";
	$title="Clientes | Estudio Contable";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include("../head.php");?>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Estudio Contable</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

      <ul class="nav navbar-nav navbar-right">
		    <li><a href="../login.php?logout"><i class='glyphicon glyphicon-off'></i> Cerrar sesion</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">
    <div class="jumbotron">
        <h2>Bienvenido, <?php echo $_SESSION['cliente_name'];?></h2>
        <h5>A continuación el detalle de su estado de cuenta.</h5>
        <div class="row">
          <div class="col-md-12">
            <!-- <div class="alert alert-danger" role="alert"><strong>Urgente!</strong> Por favor comuniquese con el contador (pero tené cuidado porque es estafador!)</div> -->
          </div>
          <div class="col-md-6">
              <ul class="list-group">

                <li class="list-group-item">
                    <span class="badge">$ 14777</span>
                    Monto a pagar <? echo "categoria A" ;?>
                </li>
                <li class="list-group-item">
                    <span class="badge">$ 10000</span>
                    Facturacion Actual
                </li>
                <li class="list-group-item">
                    <span class="badge">$ 14000</span>
                    Monto a facturar por mes
                </li>
                <li class="list-group-item">
                    <span class="badge">$ 14000</span>
                    Monto a pagar siguiente Categoria
                </li>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-md-6">Constancias / Documentos</div>
                    <div class="col-md-6">
                      <ul>
                        <li><a href="#"> Form. 960 </a></li>
                        <li><a href="#"> Inscripcion de AFIP </a></li>
                        <li><a href="#"> Inscripcion de IIBB </a></li>
                        <li><a href="#"> Credencial de pago </a></li>
                      </ul>
                    </div>
                  </div>


                </li>
            </ul>
            <h4><div class="alert alert-info" >Honararios $1500</div></h4>
          </div>
          <div class="col-md-6">
            <div class="well" style="background-color:#ffff">
            <h5><i><b>Enviar un mensaje al contador </b></i><span class="glyphicon glyphicon-send"></span></h5>
              <form>
                  <div class="form-group">
                    <input type="text" class="form-control" id="asunto" placeholder="Asunto">
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" id="texto" placeholder="..."></textarea>
                  </div>
                  <div class="form-group " style="text-align:right;">
                    <button type="submit" class="btn btn-primary">Enviar</button>
                  </div>

                </form>
            </div>

          </div>
        </div>

    </div>
</div>




<?php
	include("../footer.php");
	?>
</body>
</html>