<?php

	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
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
		  $sTable = "categorias";
		 $sWhere = " where 1 = 1 ";
		if ( $_GET['q'] != "" )
		{
		 //$sWhere.= " and  (clientes.nombre_cliente like '%$q%' or facturas.numero_factura like '%$q%')";
			
		}
		
		$sWhere.=" order by categorias.categoria asc";
		include 'pagination.php'; //include pagination file
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
		$reload = './categorias.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			echo mysqli_error($con);
			?>
			<div class="table-responsive">
			  <table class="table table-bordered table-condensed table-hover" style="font-size:11px;">
				<tr>
					<!-- <th>#</th> -->
					<th>Categoria</th>
					<th>Ingresos brutos</th>
					<th>Actividad</th>
					<th>Cantidad Mínima de Empleados</th>
					<th>Sup. Afectada</th>
					<th>Energía Eléctrica Consumida Anualmente</th>
					<th>Alquileres Devengados Anualmente</th>
					<th>Locaciones y/o Prestaciones de Servicios</th>
					<th>Venta de Cosas Muebles</th>
					<th>Aportes al SIPA</th>
					<th>Aportes Obra Social</th>
					<th>Total Locaciones y/o prestaciones de servicios</th>
					<th>Total Venta de Cosas Muebles</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
					?>
					<tr>
						<td><?php echo $row['categoria']; ?></td>
						<td><?php echo $row['ingresos_brutos']; ?></td>
						<td><?php echo $row['actividad']; ?></td>
						<td><?php echo $row['can_min_emp']; ?></td>
						<td><?php echo $row['sup_afe']; ?></td>
						<td><?php echo $row['ene_ele_con_anual']; ?></td>
						<td><?php echo $row['alq_dev_anual']; ?></td>
						<td><?php echo $row['pres_serv']; ?></td>
						<td><?php echo $row['ven_cos_muebles']; ?></td>
						<td><?php echo $row['aporte_sipa']; ?></td>
						<td><?php echo $row['aporte_os']; ?></td>
						<td><?php echo $row['t_pres_serv']; ?></td>
						<td><?php echo $row['t_ven_cos_muebles']; ?></td>
						
						
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=14><span class="pull-right"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>