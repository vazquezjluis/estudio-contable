<?php

	include('../is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_categoria=intval($_GET['id']);
		$del1="delete from categorias where id='".$id_categoria."'";
		
		if ($delete1=mysqli_query($con,$del1)){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se puedo eliminar los datos
			</div>
			<?php
			
		}
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		  $sTable = "clientes";
		 $sWhere = " INNER JOIN vencimientosiibblocales AS vl ON vl.TerminacionCUIT = SUBSTRING(cuit ,- 1) ";
		if ( $_GET['q'] != "" )
		{
		 //$sWhere.= " and  (clientes.nombre_cliente like '%$q%' or facturas.numero_factura like '%$q%')";
			
		}
		
		$sWhere.=" order by vencimiento DESC";
		include '../pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/

        //$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        
		//$row= mysqli_fetch_array($count_query);
		//$numrows = $row['numrows'];
		//$total_pages = ceil($numrows/$per_page);
		$reload = './categorias.php';
		//main query to fetch the data
		//$sql="SELECT nombre_cliente, cuit, vl.Anticipo".substr(date('m'), -1)." as vencimientosiibblocales FROM  ".$sTable.$sWhere." LIMIT ".$offset.",".$per_page;
		$mes = (int)substr(date('m'), -1)-1;
		$sql = "SELECT
			nombre_cliente,
			cuit,
			STR_TO_DATE(vl.Anticipo".$mes.",'%d/%m/%Y') AS vencimiento, 'IIBB' as tipo
		FROM
			clientes
		INNER JOIN vencimientosiibblocales AS vl ON vl.TerminacionCUIT = SUBSTRING(cuit ,- 1)

		UNION

		SELECT
			nombre_cliente,
			cuit,
			fm.fecha AS vencimiento, 'Monotributo' as tipo
		FROM
			clientes
			INNER JOIN (select * from fechamonotributo ORDER BY id_fechamonotributo DESC LIMIT 1 )AS fm



		ORDER BY
			vencimiento ASC";


		//var_dump($sql);
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		//if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table class="table table-bordered table-condensed table-hover" style="font-size:12px;">
				<tr>
					<!-- <th>#</th> -->
					<th>Cliente</th>
					<th>Cuit</th>
					<th>Vencimiento</th>
					<th>Tipo</th>
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
					?>
					<tr>
						<td><?php echo $row['nombre_cliente']; ?></td>
						<td><?php echo $row['cuit']; ?></td>
						<td><?php
						
						$date=date_create($row['vencimiento']);
						echo date_format($date,"d/m/Y");
						
						 ?></td>
						<td><?php echo $row['tipo']; ?></td>
						
					</tr>
					<?php
				}
				?>
			  </table>
              <div class="pull-right">
              <a href="ajax/vencimientos/excel.php" class="btn btn-success">Descargar Excel <span class="glyphicon glyphicon-download-alt "></span></a>
              </div>
			</div>
			<?php
		//}
	}
?>