<?php

	/*-------------------------
	Autor: Jose Luis Vazquez
	Web: control-app.com
	Mail: info@control-app.com
	---------------------------*/
	include('../is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_cliente=intval($_GET['id']);
		$query=mysqli_query($con, "select * from facturas where id_cliente='".$id_cliente."'");
		$count=mysqli_num_rows($query);
		if ($count==0){
			if ($delete1=mysqli_query($con,"DELETE FROM clientes WHERE id_cliente='".$id_cliente."'")){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php 
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php
			
		}
			
		} else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> No se pudo eliminar éste  cliente. Existen facturas vinculadas a éste producto. 
			</div>
			<?php
		}
		
		
		
	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('nombre_cliente');//Columnas de busqueda
		 $sTable = "clientes";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by nombre_cliente";
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
		$reload = './clientes.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table table-bordered table-condensed table-hover">
				<tr>
					<th>Razon Social</th>
					<!-- <th>Teléfono</th>
					<th>Email</th>
					<th>Dirección</th> -->
					<th>Cuit</th>
					<th>Condicion IVA</th>
					<th>Inicio de actividades</th>
					<th>Honorarios</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_cliente=$row['id_cliente'];
						$nombre_cliente=$row['nombre_cliente'];
						$telefono_cliente=$row['telefono_cliente'];
						$email_cliente=$row['email_cliente'];
						$direccion_cliente=$row['direccion_cliente'];
						$status_cliente=$row['status_cliente'];
						$cuit=$row['cuit'];
						$categoria=$row['categoria'];
						$condicion_iva=$row['condicion_iva'];
						$honorarios=$row['honorario'];
						$usuario=$row['usuario'];
						$clave=$row['clave'];
						$date_added=date('Y-m-d', strtotime($row['date_added']));
						if ($status_cliente==1){$estado="Activo";}
						else {$estado="Inactivo";}
						$fecha_inicio= date('d/m/Y', strtotime($row['date_added']));


						if ($row['categoria']!=null and $row['categoria']!="") {
							$condicion_iva_str = $row['condicion_iva']." '".$row['categoria']."'";
						}
						
					?>
					
					<input type="hidden" value="<?php echo $nombre_cliente;?>" id="nombre_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $telefono_cliente;?>" id="telefono_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $email_cliente;?>" id="email_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $direccion_cliente;?>" id="direccion_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $status_cliente;?>" id="status_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $cuit;?>" id="cuit<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $categoria;?>" id="categoria<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $condicion_iva;?>" id="condicion_iva<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $date_added;?>" id="date_added<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $honorarios;?>" id="honorarios<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $usuario;?>" id="usuario<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $clave;?>" id="clave<?php echo $id_cliente;?>">
					
					<tr>
						
						<td><?php echo $nombre_cliente; ?></td>
						<!-- <td ><?php //echo $telefono_cliente; ?></td>
						<td><?php //echo $email_cliente;?></td>
						<td><?php //echo $direccion_cliente;?></td>
						<td><?php //echo $estado;?></td> -->
						<td><?php echo $cuit;?></td>
						<td><?php echo $condicion_iva." ".$categoria;?></td>
						<td><?php echo $fecha_inicio;?></td>
						<td><?php echo "$ ".$honorarios;?></td>
						
					<td ><span class="pull-right">
						<a href="#" class='btn btn-default btn-xs' title='Movimientos' onclick="movimientos('<?php echo $id_cliente;?>');" data-toggle="modal" data-target="#myModal3"><i class="glyphicon glyphicon-list"></i> Movimientos</a> 
						<a href="#" class='btn btn-default btn-xs' title='Documentos'  data-toggle="modal" data-target="#nuevoDocumento"><i class="glyphicon glyphicon-cloud-upload"></i> Documentos</a> 
						<a href="#" class='btn btn-default btn-xs' title='Editar cliente' onclick="obtener_datos('<?php echo $id_cliente;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a> 
						<a href="#" class='btn btn-default btn-xs' title='Borrar cliente' onclick="eliminar('<?php echo $id_cliente; ?>')"><i class="glyphicon glyphicon-trash"></i></a></span> 
					</td>
						
					</tr>
					<?php
				}
				?>
			  </table>
			  <div>
			  	<span class="pull-right" >
			  	<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
				?>
				</span>
			  </div>
			</div>
			<?php
		}
	}else if ($action =="valida"){
		$usuario	= trim($_GET['usuario']);
		
		$sql = "select * from clientes where usuario='".$usuario."' ";
		
		if (isset($_GET['id_cliente'])){
			$sql.= " AND id_cliente != ".trim($_GET['id_cliente']);
		}

		$query=mysqli_query($con,$sql );
		$count=mysqli_num_rows($query);
		
		if ($count!=0){
			echo "error";
		}else{
			echo "ok";
		}
	}
?>