<?php 

function get_row($table,$row, $id, $equal){
	global $con;
	$query=mysqli_query($con,"select $row from $table where $id='$equal'");
	$rw=mysqli_fetch_array($query);
	$value=$rw[$row];
	return $value;
}

function  monto_limite_categoria($categoria){
	global $con;
	 	 /** Obtengo los datos de la categoria del cliente */
		$limite_categoria= 0;  
		if(isset($_SESSION['cliente_condicion_iva']) and $_SESSION['cliente_condicion_iva']=="Monotributo" ){
			$sql = "SELECT * FROM categorias WHERE categoria = '".trim($categoria)."'";
			$query=mysqli_query($con, $sql);
			$row= mysqli_fetch_array($query);
			$limite_categoria = $row['ingresos_brutos'];	
			
		}
		return $limite_categoria;
}
/**  */
function getMontoAPagar($categoria){
		global $con;
	 	 /** Obtengo los datos de la categoria del cliente */
		$monto_a_pagar= 0;  
		if(isset($_SESSION['cliente_condicion_iva']) and $_SESSION['cliente_condicion_iva']=="Monotributo" ){
			$sql = "SELECT * FROM categorias WHERE categoria = '".trim($categoria)."'";
			$query=mysqli_query($con, $sql);
			$row= mysqli_fetch_array($query);
			if ($row['actividad']=='Venta de Cosas Muebles'){
				$monto_a_pagar = $row['t_ven_cos_muebles'];
			}else{
				//si la categoria es mayor a la H entonces ese es el limite H
				$categorias_tope = array ('I','J','K');
				if (in_array($categoria,$categorias_tope)){
					$sql2 = "SELECT * FROM categorias WHERE categoria = 'H' ";
					$query2=mysqli_query($con, $sql2);
					$row2= mysqli_fetch_array($query2);
					$monto_a_pagar = $row2['t_pres_serv'];
				}else {
					$monto_a_pagar = $row['t_pres_serv'];
				}
				
			}	
			
		}
		return $monto_a_pagar;
}
/**  */
function getFacturacionActual($id_cliente){
	global $con;
	/** Facturarion Actual */
	$mes_Actual = date('m');
	$primer_semestre 	= array('enero','febrero','marzo','abril','mayo','junio');
	$segundo_semestre 	= array('julio','agosto','septiembre','octubre','noviembre','diciembre');

	$total_ingreso = 0;
	$total_egreso  = 0;
	if($mes_Actual<"07"){//julio 
		//Primer semestre
		// se obtienen los datos a partir del 1 de julio del año anterior
		$sql_1 =" SELECT movimiento,anio,julio,agosto, septiembre, octubre, noviembre, diciembre FROM movimientos  WHERE anio = YEAR(NOW())-1  and cliente = ".$id_cliente;
		$sql_2 =" SELECT movimiento,anio,enero, febrero, marzo, abril, mayo, junio 			     FROM movimientos  WHERE anio = YEAR(NOW())    and cliente = ".$id_cliente;
		$query1=mysqli_query($con,$sql_1);		
		$query2=mysqli_query($con,$sql_2);	
		while($row1=mysqli_fetch_assoc($query1)){
			$r[]=$row1;
			if ($row1['movimiento']=="ingresos"){
				foreach($segundo_semestre as $mes){
					$total_ingreso += $row1[(string)$mes];	
				}
			}else{
				foreach($segundo_semestre as $mes){
					$total_egreso += $row1[(string)$mes];	
				}
			}
		}	
		while($row2=mysqli_fetch_assoc($query2)){
			$r[]=$row2;
			if ($row2['movimiento']=="ingresos"){
				foreach ($primer_semestre as $mes){
					$total_ingreso += $row2[(string)$mes];
				}
			}else{
				foreach ($primer_semestre as $mes){
					$total_egreso += $row2[(string)$mes];
				}
				
			}
		}
		
		
	}else{
		//segundo semestre
		//se suma desde el 1 de enero del año vigente
		$sql="SELECT * FROM movimientos WHERE cliente = ".$id_cliente." AND anio = YEAR(NOW()) ";
		$query=mysqli_query($con,$sql);		
		$meses = array_merge($primer_semestre,$segundo_semestre);

		while($row=mysqli_fetch_assoc($query)){
			$r[]=$row;
			if ($row['movimiento']=="ingresos"){
				foreach ($meses as $mes){
					$total_ingreso += $row[(string)$mes];
				}
			}else{
				foreach ($meses as $mes){
					$total_egreso += $row[(string)$mes];
				}
			}
		}
	}
	$r[]['total_ingreso'] =$total_ingreso; 
	$r[]['total_egreso'] =$total_egreso; 
	
	return $r;
}


function mesIncompleto($movimientos){
	$mes_que_falta = 0;
	foreach($movimientos as $mov){
		
		if (in_array('ingresos',$mov)){
			
			foreach($mov as $key=> $m){
				if ($key!='movimiento' AND $key!='anio' AND $key!='total_egreso' ){
					if ($m =='00.00'){
					
						$mes_que_falta++;
					}
				}
				
			}	
		}
	}
	return $mes_que_falta;
}

function getMesesQueFaltan(){
		// Funciones de fecha 
		$hoy 		= new DateTime(date('Y-m-d'));
		$julio 		= new DateTime(date('Y')."-07-01");
		$diciembre 	= new DateTime(date('Y')."-12-01");
		$mes_Actual = date('m');
		if($mes_Actual<"07"){//julio 
		$meses_que_faltan = $hoy->diff($julio);
		}else{
		$meses_que_faltan = $hoy->diff($diciembre);
		}
		return $meses_que_faltan->m;
}


?>