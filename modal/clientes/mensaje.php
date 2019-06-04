<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="nuevoMensaje" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">

		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Enviar mensaje</h4>
          </div>
          
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_mensaje" name="guardar_mensaje" enctype="multipart/form-data">
			 	
				<input type="hidden" name="mensaje_cliente" id="mensaje_cliente">
				<input type="hidden" name="destino" id="destino" value="cliente">
				<input type="hidden" name="visto" id="visto" value="0">
				<input type="hidden" name="visto" id="visto" value="0">
				<input type="hidden" name="estado" id="estado" value="1">
                <div id="mensaje_ajax"></div>
                
                
                <div class="form-group">
                    <label for="prioridad" class="col-sm-3 control-label">Prioridad *</label>
                    <div class="checkbox col-sm-8">
                        <label class="alert alert-danger"  style="padding:1%;"><input type="radio" value="3" name="prioridad"> <b>Alta </b></label>
                        <label class="alert alert-warning" style="padding:1%;"><input type="radio" value="2" name="prioridad"> <b>Media</b></label>
						<label class="alert alert-success" style="padding:1%;"><input type="radio" value="1" name="prioridad"> <b>Baja </b></label>
                    </div>
                </div>
				<div class="form-group">
                    <label  class="col-sm-3 control-label">Asunto *</label>
                    <div class="col-sm-8">
                        <input type="text" name="asunto" class="form-control"  required >
                        
                    </div>
			    </div>
				<div class="form-group">
                    <label  class="col-sm-3 control-label">Mensaje *</label>
                    <div class="col-sm-8">
                        <textarea name="mensaje" class="form-control"  required ></textarea>
                        
                    </div>
			    </div>
		  	
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					<button class="btn btn-primary" type='submit' name="guardar_mensaje" id="guardar_mensaje"  value="Guardar archivo">Enviar</button>
                </div>
                
		    </form>
         </div>

	  </div>
	</div>
</div>
	<?php
		}
	?>