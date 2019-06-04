<?php
	/*-------------------------
	Autor: Jose Luis Vazquez
	Web: www.control-app.com
	Mail: info@control-app.com
  ---------------------------*/
  error_reporting(E_ALL & ~E_DEPRECATED);
	session_start();
	if (!isset($_SESSION['cliente_login_status']) AND $_SESSION['cliente_login_status'] != 1) {
        header("location: ../login.php");
		exit;
        }

	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

  require_once ("../funciones.php");
	$active_facturas="";
	$active_productos="";
	$active_clientes="active";
	$active_usuarios="";
  $title="Clientes | Estudio Contable";

$categorias = array("A","B","C","D","E","F","G","H","I","J","K","L");
foreach($categorias as $k =>$v){
  if  (trim($_SESSION['cliente_categoria'])==$v){
    $siguiente_categoria = $categorias[$k+1];
    break;
  }

}

$monto_a_pagar            = getMontoAPagar(trim($_SESSION['cliente_categoria']));//Es el monto que figura en la categoria
$facturacion_actual       = getFacturacionActual($_SESSION['cliente_id']);//Suma de la facturacion hasta el momento 
$mes_incompleto           = mesIncompleto($facturacion_actual);//meses que restan para la proxima recategorizacion
$monto_a_facturar_por_mes = ( $monto_a_pagar - $facturacion_actual[4]['total_ingreso'] ) / $mes_incompleto;
$monto_a_pagar_sig_cate   = getMontoAPagar($siguiente_categoria);
 

//Documentos del cliente
$sql_documento="SELECT * FROM  documentos WHERE cliente = ".$_SESSION['cliente_id'];
$query_documentos = mysqli_query($con, $sql_documento);

$tipo_documento = array(
  1=>"inscripcion de AFIP",
  2=>"inscripcion de IIBB",
  3=>"Form. 960",
  4=>"Credencial de Pago"
);
$sql_mensaje="SELECT * FROM  mensajes WHERE cliente = ".$_SESSION['cliente_id']." AND visto = '0' AND destino = 'cliente' ";

$query_mensaje = mysqli_query($con, $sql_mensaje);
 

$class = array(
  0=>"well",
  1=>"alert alert-success",
  2=>"alert alert-warning",
  3=>"alert alert-danger"
);

//mensajed

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title><?php echo $title;?></title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	
	<link rel="stylesheet" href="../css/custom.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel=icon href='../img/logo-icon.png' sizes="32x32" type="image/png">
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
    <div class="jumbotron" style="padding-top:0px;">
        <div class="row">
          <div class="col-md-12">
            
            <div class="row">
                  <div class="col-md-6" style="text-align:center">
                    <h1 style="font-family:Arial;font-size:2.5em;"><?php echo strToUpper($_SESSION['cliente_name']);?></h1>
                    <?php 
                      if ($_SESSION['cliente_condicion_iva']=="Monotributo"){ ?>
                          <div class="letraCliente"><?php echo $_SESSION['cliente_categoria']?></div>
                    <?php  }
                    ?>
                    
                  </div>
                  <div class="col-md-6" style="text-align:center;padding-top:1%;">
                  <?php 
                    if ($query_mensaje->num_rows!=0){
                        while($men= mysqli_fetch_array($query_mensaje)){?>
                          <div class="<?php echo $class[$men['prioridad']]; ?>" role="alert">
                            <strong><?php echo $men['asunto'];?></strong> 
                            <?php echo $men['mensaje'];?>
                          </div> 
                          <?php
                          //modifica el visto del mensaje
                          $update_mensaje="UPDATE  mensajes set  visto = '".date('Y-m-d h:m:s')."' where id_mensaje =  ".$men['id_mensaje'];
                          mysqli_query($con, $update_mensaje);
                          }
                        } ?>
                  </div>
                  
                </div>  
          </div>
          <div class="col-md-6">
              <ul class="list-group" style="margin-bottom:5px;">
                
              
                <li class="list-group-item " style="padding:1%;">
                    <span class="badge">$ <?php echo " ".number_format($monto_a_pagar, 2,'.',' ');?></span>
                    Monto a pagar
                </li>
                <li class="list-group-item " style="padding:1%;">
                    <span class="badge">$ <?php echo " ".number_format($facturacion_actual[4]['total_ingreso'], 2,'.',' '); ?></span>
                    Facturacion Actual
                </li>
                <li class="list-group-item sm " style="padding:1%;">
                    <span class="badge">$ <?php echo " ".number_format($monto_a_facturar_por_mes, 2,'.',' ');?></span>
                    Monto a facturar por mes
                </li>
                <li class="list-group-item " style="padding:1%;">
                    <span class="badge">$ <?php echo " ".number_format($monto_a_pagar_sig_cate, 2,'.',' ');?></span>
                    Monto a pagar siguiente Categoria (<?= $siguiente_categoria;?>)
                </li>
                <li class="list-group-item" style="padding:1%;">
                  <div class="row" style="text-align:center;">
                    <h3 style="margin-top:0px;margin-bottom:0px;">Constancias</h3>
                  </div>  
                    
                      <ul>
                      <?php
                        if ($query_documentos->num_rows!=0){
                          while($doc= mysqli_fetch_array($query_documentos)){
                            ?>
                              <li><a href="../<?php echo $doc['ruta']?>" target="_blanck"> <?php echo $tipo_documento[$doc['tipo']]; ?> <span class="glyphicon glyphicon-download-alt"></span></a></li>
                            <?php
                          }
                        } else{
                          echo " <br>Sin documentos cargados<br>";
                        }
                        ?>
                      </ul>
                </li>
            </ul>
            <button type="button" style="margin-top:" name="" id="" class="btn btn-primary btn-sm btn-block">
              Liquidacion mensual de Ingresos Brutos
            </button>
            <h4>Honararios $<?php echo $_SESSION['cliente_honorario'];?></h4>
          </div>
          <div class="col-md-6">
            <div class="row">
                  <div class="col-md-12" style="text-align:center">
                  
                  </div>
            </div>  
            <div class="well" style="background-color:#ffff">
            <h5><i><b>Enviar un mensaje al contador </b></i><span class="glyphicon glyphicon-send"></span></h5>
              <form method="post" id="guardar_mensaje" name="guardar_mensaje">
                  <div class="form-group">
                    <div id="mensaje_ajax"></div>
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control" id="asunto" name="asunto" placeholder="Asunto" required>
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" id="mensaje" name="mensaje" placeholder="..." required></textarea>
                  </div>
                  <input type="hidden" name="mensaje_cliente" value="<?php echo $_SESSION['cliente_id']; ?>">
                  <input type="hidden" name="visto" value="0">
                  <input type="hidden" name="prioridad" value="0">
                  <input type="hidden" name="estado" value="1">
                  <input type="hidden" name="destino" value="contador">
                  <input type="hidden" name="send" value="1">
                  <div class="form-group " style="text-align:right;">
                    <button type="submit" class="btn btn-primary" id="enviar_mensaje">Enviar</button>
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
    <script type="text/javascript" >
      $("#guardar_mensaje").submit(function(event) {
		    $('#enviar_mensaje').attr("disabled", true);

		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "../ajax/cliente/mensaje.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax").html("Mensaje: Enviando...");
		        },
		        success: function(datos) {
		            $("#resultados_ajax").html(datos);
		            $('#enviar_mensaje').attr("disabled", false);
		            $('#guardar_mensaje')[0].reset();
		            //load(1);
		        }
		    });
		    event.preventDefault();
		})
    </script>
</body>
</html>