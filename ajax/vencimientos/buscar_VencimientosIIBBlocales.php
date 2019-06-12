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
		  $sTable = "vencimientosiibblocales";
		 $sWhere = " where 1 = 1 ";
		if ( $_GET['q'] != "" )
		{
		 //$sWhere.= " and  (clientes.nombre_cliente like '%$q%' or facturas.numero_factura like '%$q%')";
			
		}
		
		$sWhere.="  order by vencimientosiibblocales.id asc ";
		include '../pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/

		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './VencimientosIIBBlocales.php';
		//main query to fetch the data
		//$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$sql="SELECT * FROM  $sTable $sWhere LIMIT 13";



		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table class="table table-bordered table-condensed table-hover" style="font-size:11px;">
				<tr>
					<!-- <th>#</th> -->
					<th>Terminacion del cuit</th>
					<th>Anticipo1</th>
					<th>Anticipo2</th>
					<th>Anticipo3</th>
					<th>Anticipo4</th>
					<th>Anticipo5</th>
					<th>Anticipo6</th>
					<th>Anticipo7</th>
					<th>Anticipo8</th>
					<th>Anticipo9</th>
					<th>Anticipo10</th>
					<th>Anticipo11</th>
					<th>Anticipo12</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
					?>
					<tr>
						<td><?php echo $row['TerminacionCUIT']; ?></td>
						<td><?php echo $row['Anticipo1']; ?></td>
						<td><?php echo $row['Anticipo2']; ?></td>
						<td><?php echo $row['Anticipo3']; ?></td>
						<td><?php echo $row['Anticipo4']; ?></td>
						<td><?php echo $row['Anticipo5']; ?></td>
						<td><?php echo $row['Anticipo6']; ?></td>
						<td><?php echo $row['Anticipo7']; ?></td>
						<td><?php echo $row['Anticipo8']; ?></td>
						<td><?php echo $row['Anticipo9']; ?></td>
						<td><?php echo $row['Anticipo10']; ?></td>
						<td><?php echo $row['Anticipo11']; ?></td>
						<td><?php echo $row['Anticipo12']; ?></td>
						
						
						
					</tr>
					<?php
				}
				?>
			  </table>
              <div class="pull-right">
              <?php
					 //echo paginate($reload, $page, $total_pages, $adjacents);
					?>
              </div>
			</div>
			<?php
		}
	}
?>