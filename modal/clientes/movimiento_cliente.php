<?php
		if (isset($con))
		{
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
                    <div class="col-md-6">
                        <table id="tabla_1"  class="table table-bordered table-condenced table-hover">
                            <thead>
                                <tr><th colspan="2">Monto Facturado</th></tr>
                                <tr>
                                    <th>Periodo</th>
                                    <th>Monto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Enero</td>
                                    <td id="mf_enero" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Febrero</td>
                                    <td id="mf_febrero" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Marzo</td>
                                    <td id="mf_marzo" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Abril</td>
                                    <td id="mf_abril" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Mayo</td>
                                    <td id="mf_mayo" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Junio</td>
                                    <td id="mf_junio" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Julio</td>
                                    <td id="mf_julio" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Agosto</td>
                                    <td id="mf_agosto" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Septiembre</td>
                                    <td id="mf_septiembre" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Octubre</td>
                                    <td id="mf_octubre" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Noviembre</td>
                                    <td id="mf_noviembre" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Diciembre</td>
                                    <td id="mf_diciembre" contenteditable="true"></td>
                                </tr>
                               
                            </tbody>
                            <thead>
                                <tr>
                                    <th>Total</th>
                                    <th id="mf_total"></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-6">
                    <table style="background-color:#ffc1071c" class="table table-bordered table-condenced table-hover">
                            <thead>
                                <tr><th colspan="2">Gastos</th></tr>
                                <tr>
                                    <th>Periodo</th>
                                    <th>Monto $</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Enero</td>
                                    <td id="g_enero" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Febrero</td>
                                    <td id="g_febrero" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Marzo</td>
                                    <td id='g_marzo' contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Abril</td>
                                    <td id="g_abril" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Mayo</td>
                                    <td id="g_mayo" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Junio</td>
                                    <td  id="g_junio"contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Julio</td>
                                    <td id="g_julio" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Agosto</td>
                                    <td id="g_agosto" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Septiembre</td>
                                    <td id="g_septiembre" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Octubre</td>
                                    <td id="g_octubre" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Noviembre</td>
                                    <td id="g_noviembre" contenteditable="true"></td>
                                </tr>
                                <tr>
                                    <td>Diciembre</td>
                                    <td id="g_diciembre"  contenteditable="true"></td>
                                </tr>
                               
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