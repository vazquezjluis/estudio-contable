<?php
	include('../is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	switch($_GET['accion']){
		case 'get':
		if (empty($_GET['id'])) {
			$errors[] = "ID vacío";
		}else{
			/* Connect To Database*/
			require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
			require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
			
			$sql="SELECT * FROM movimientos WHERE cliente = ".$_GET['id']." AND anio = YEAR(NOW())";
			$query=mysqli_query($con,$sql);		
			
			while($row=mysqli_fetch_assoc($query)){
				$r[]=$row;
			}
			echo json_encode($r);
		}

		break;
		case 'update':
			if (empty($_GET['id'])) {
				$errors[] = "ID vacío";
			} 
			else if (!empty($_GET['id']) && !empty($_GET['name']) && !empty($_GET['valor']))
			{
				/* Connect To Database*/
				require_once ("../../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
				require_once ("../../config/conexion.php");//Contiene funcion que conecta a la base de datos
				
				$id_cliente=intval($_GET['id']);//id del cliente
				$td_name = explode('_',$_GET['name']);//nombre del td mf_abril
				$valor = str_replace(",", ".", $_GET['valor']);// valor 150.5 se cambia las comas por puntos
				$movimiento = ($td_name[0]=='mf')? 'ingresos' :	'egresos';
				$mes = strtolower($td_name[1]);
		
				$sql = " UPDATE movimientos SET ".$mes." = ".$valor." WHERE cliente = ".$id_cliente." AND anio=YEAR(NOW())  AND movimiento = '".$movimiento."'";
				
				$query_update = mysqli_query($con,$sql);
				if ($query_update){
					$messages[] = "guardado.";
				} else{
					$errors []= "Ocurrio un error al intentar guardar el movimiento. ".mysqli_error($con);
				}
			} else {
				$errors []= "Error desconocido.";
			}
				
			$request ="";
			if (isset($errors)){
				foreach ($errors as $error) {
					$request.= $error;
				}
			}
 
	 if (isset($messages)){
		 foreach ($messages as $message) {
			 $request.= $message;
		 }
	 }
 
	 echo $request;
		break;
		 
	}
	

?>