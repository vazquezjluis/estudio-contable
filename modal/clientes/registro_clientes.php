	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo cliente</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_cliente" name="guardar_cliente">
			<div id="resultados_ajax"></div>

			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre *</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre" name="nombre" required>
				</div>
			  </div>

				<div class="form-group">
					<label for="cuit" class="col-sm-3 control-label">Cuit *</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="cuit" name="cuit"  required>
					</div>
			  </div>

			  <div class="form-group">
					<label for="condicion" class="col-sm-3 control-label">Cond. ante el IVA *</label>
					<div class="col-sm-8">
						<select class="form-control" id="condicion" name="condicion"  required>
							<option value="">-- Selecciones--</option>
							<option value="1">Responsable Monotributo</option>
							<option value="2">IVA Responsable no Inscripto</option>
							<option value="3">IVA Responsable Inscripto</option>
							<option value="4">IVA no Responsable</option>
							<option value="5">IVA Sujeto Exento</option>
						</select>
					</div>
				</div>

			  <div class="form-group" id="categoria_div" style="display:none">
					<label for="categoria" class="col-sm-3 control-label">Categoria *</label>
					<div class="col-sm-8">
					<input type="text" class="form-control" id="categoria" name="categoria" value=" "  required>
					</div>
				</div>

			  <div class="form-group">
					<label for="date_added" class="col-sm-3 control-label">Fecha Inicio de actividades *</label>
					<div class="col-sm-8">
						<input type="date" class="form-control" id="date_added" name="date_added"  required>
					</div>
			  </div>

			  <div class="form-group">
					<label for="honorario" class="col-sm-3 control-label">Honorarios $</label>
					<div class="col-sm-8">
						<input type="number" class="form-control" id="honorario" name="honorario"  required>
					</div>
			  </div>

			  <div class="form-group">
					<label for="usuario" class="col-sm-3 control-label">Usuario</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="usuario" name="usuario"  required>
					</div>
			  </div>

			  <div class="form-group">
					<label for="clave" class="col-sm-3 control-label">Clave</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="clave" name="clave"  required>
					</div>
			  </div>

			  <div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Teléfono</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="telefono" name="telefono" >
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="email" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" id="email" name="email" >				  
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="direccion" class="col-sm-3 control-label">Dirección</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="direccion" name="direccion"   maxlength="255" ></textarea>				  
				</div>
			  </div>
			  
			  <!-- <div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Estado</label>
				<div class="col-sm-8">
				 <select class="form-control" id="estado" name="estado" required>
					<option value="">-- Selecciona estado --</option>
					<option value="1" selected>Activo</option>
					<option value="0">Inactivo</option>
				  </select>
				</div>
			  </div> -->
			 
			 
			 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>