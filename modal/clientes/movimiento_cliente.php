<?php
		if (isset($con))
		{

            $meses = array('enero','febrero','marzo','abril','mayo','junio','julio','agosto','septiembre','octubre','noviembre','diciembre');
            $periodo = array(
                (string)(date('Y')-1)   =>$meses,
                (string)date('Y')       =>$meses
                
            );
            
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">

		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-list'></i> Movimientos de <span id="modal_nombre"></span></h4>
            <input type="hidden" name="id_cliente" id="id_cliente" >
		  </div>

		  <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6  table-responsive"  >
                        
                    
                        <table id="tabla_1"  class="table table-bordered table-condensed table-hover">
                            <thead>
                                <tr><th colspan="2">Monto Facturado</th></tr>
                                <tr>
                                    <th>Periodo</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="mf_"></tr>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>Total</th>
                                    <th id="mf_total"></th>
                                </tr>
                            </thead>
                        </table>
                        
                    </div>
                    <div class="col-md-6 table-responsive" >
                    <table style="background-color:#ffc1071c" class="table table-bordered table-condensed table-hover">
                            <thead>
                                <tr><th colspan="2">Gastos</th></tr>
                                <tr>
                                    <th>Periodo</th>
                                    <th>Monto $</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="g_"></tr>
                                
                            </tbody>
                            <thead>
                                <tr>
                                    <th>Total</th>
                                    <th id="g_total"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-12" id='total_general'></div>
                </div>    
            </div>
          </div>

		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<!-- <button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar datos</button> -->
		  </div>

		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
    <script>

    </script>