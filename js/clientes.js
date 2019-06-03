		$(document).ready(function() {
		    load(1);

		});

		function load(page) {
		    var q = $("#q").val();
		    $("#loader").fadeIn('slow');
		    $.ajax({
		        url: './ajax/cliente/buscar_clientes.php?action=ajax&page=' + page + '&q=' + q,
		        beforeSend: function(objeto) {
		            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(data) {
		            $(".outer_div").html(data).fadeIn('slow');
		            $('#loader').html('');

		        }
		    })
		}



		function eliminar(id) {
		    var q = $("#q").val();
		    if (confirm("Realmente deseas eliminar el cliente")) {
		        $.ajax({
		            type: "GET",
		            url: "./ajax/cliente/buscar_clientes.php",
		            data: "id=" + id,
		            "q": q,
		            beforeSend: function(objeto) {
		                $("#resultados").html("Mensaje: Cargando...");
		            },
		            success: function(datos) {
		                $("#resultados").html(datos);
		                load(1);
		            }
		        });
		    }
		}

		$("#usuario").focusout(function (){
			vaildarClienteUsuario($(this).val(),'','');
		});
		$("#mod_usuario").focusout(function (){
			vaildarClienteUsuario($(this).val(),'mod_',$("#mod_id").val());
		});

		function vaildarClienteUsuario(usuario,prefijo,id_cliente){
			var cadena = ''
			if (id_cliente !==''){
				cadena +='&id_cliente='+id_cliente;
			}
			$.ajax({
		        url: './ajax/cliente/buscar_clientes.php?action=valida&usuario=' + usuario+cadena,
		        beforeSend: function(objeto) {
		            $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
		        },
		        success: function(data) {
					if (data === 'error'){
						$("#"+prefijo+"respuesta").text('El usuario ya existe.').fadeIn('slow').addClass('label label-danger');
						$("#actualizar_datos").attr('disabled',true);
						$("#guardar_datos").attr('disabled',true);
					}else{
						$("#"+prefijo+"respuesta").fadeOut('slow');
						$("#actualizar_datos").removeAttr('disabled');
						$("#guardar_datos").removeAttr('disabled');
					}
		            $("#"+prefijo+"loader").html('');
		        }
		    })
		}

		$("#guardar_cliente").submit(function(event) {
		    $('#guardar_datos').attr("disabled", true);

		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "ajax/cliente/nuevo_cliente.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax").html("Mensaje: Cargando...");
		        },
		        success: function(datos) {
		            $("#resultados_ajax").html(datos);
		            $('#guardar_datos').attr("disabled", false);
		            load(1);
		        }
		    });
		    event.preventDefault();
		})

		$("#editar_cliente").submit(function(event) {
		    $('#actualizar_datos').attr("disabled", true);

		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "ajax/cliente/editar_cliente.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax2").html("Mensaje: Cargando...");
		        },
		        success: function(datos) {
		            $("#resultados_ajax2").html(datos);
		            $('#actualizar_datos').attr("disabled", false);
		            load(1);
		        }
		    });
		    event.preventDefault();
		})

		/**
		 * Para mostrar o no mostrar la categoria
		 */
		$("select").change(function(event) {
		    var prefijo = "";
		    if ($(this).attr("id") === "condicion") {
		        //cuando es creadion de cliente
		    } else {
		        prefijo = "mod_"; //cuando es modificacion
		    }
		    if ($(this).val() == "Monotributo") {
		        $("#" + prefijo + "categoria").removeAttr("readonly");
		        $("#" + prefijo + "categoria").attr("required");
		        $("#" + prefijo + "categoria").val("");
		    } else {
		        $("#" + prefijo + "categoria").attr("readonly", "readonly");
		        $("#" + prefijo + "categoria").val("");
		    };
		});

		function obtener_datos(id) {
		    var nombre_cliente = $("#nombre_cliente" + id).val();
		    var telefono_cliente = $("#telefono_cliente" + id).val();
		    var email_cliente = $("#email_cliente" + id).val();
		    var direccion_cliente = $("#direccion_cliente" + id).val();
		    var status_cliente = $("#status_cliente" + id).val();
		    var cuit = $("#cuit" + id).val();
		    var categoria = $("#categoria" + id).val();
		    var date_added = $("#date_added" + id).val();
		    var honorarios = $("#honorarios" + id).val();
		    var usuario = $("#usuario" + id).val();
		    var clave = $("#clave" + id).val();
		    var condicion_iva = $("#condicion_iva" + id).val();

		    $("#mod_nombre").val(nombre_cliente);
		    $("#mod_telefono").val(telefono_cliente);
		    $("#mod_email").val(email_cliente);
		    $("#mod_direccion").val(direccion_cliente);
		    $("#mod_estado").val(status_cliente);
		    $("#mod_cuit").val(cuit);
		    $("#mod_date_added").val(date_added);
		    $("#mod_honorarios").val(honorarios);
		    $("#mod_usuario").val(usuario);
		    $("#mod_clave").val(clave);
		    $("#mod_id").val(id);

		    $("#mod_condicion option[value='" + condicion_iva + "']").attr("selected", "selected");
		    if (condicion_iva === 'Monotributo') {
		        $("#mod_categoria").val(categoria);
		    } else {
		        $("#mod_categoria").attr("readonly", "readonly");
		        $("#mod_categoria").val(" ");
		    }

		}

		/**
		 * 
		 * @param {*} id
		 * Carga los movimientos del Cliente 
		 */
		function movimientos(id) {

		    //var mes = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto'];
		    var nombre_cliente = $("#nombre_cliente" + id).val();
		    $("#modal_nombre").text(nombre_cliente);
		    $("#id_cliente").val(id);
		    $.ajax({
		        type: "GET",
		        url: "./ajax/cliente/movimiento_cliente.php?accion=get&id=" + id,
		        dataType: "json",
		        beforeSend: function(objeto) {
		            //$("#resultados_ajax").html("Mensaje: Cargando...");
		        },
		        success: function(data) {

		            // Obteniendo todas las claves del JSON
		            var tr_gastos = "";
		            var tr_facturado = "";
		            for (var clave in data) {
		                if (data.hasOwnProperty(clave)) {
		                    let valor = data[clave];

		                    if (valor.movimiento === "ingresos") { //Ingresos
		                        for (let key in valor) {
		                            if (valor.hasOwnProperty(key)) {
		                                if (key != "movimiento" && key != "anio") {
		                                    tr_facturado += "<tr><td>" + key + "-" + valor.anio + "</td><td id='mf_" + key + "_" + valor.anio + "'   contenteditable='true' onfocusout=\"upData('mf_" + String(key) + "_" + String(valor.anio) + "',this)\" >" + valor[key] + "</td></tr>";
		                                }
		                            }
		                            //console.log("La clave es " + key + " y el valor es " + valor[key]);
		                        }
		                    } else if (valor.movimiento === "egresos") { //Egresos

		                        for (let key in valor) {
		                            if (valor.hasOwnProperty(key)) {
		                                if (key != "movimiento" && key != "anio") {
		                                    tr_gastos += "<tr><td>" + key + "-" + valor.anio + "</td><td id='g_" + key + "_" + valor.anio + "'   contenteditable='true' onfocusout=\"upData('g_" + String(key) + "_" + String(valor.anio) + "',this)\" >" + valor[key] + "</td></tr>";
		                                }
		                            }
		                            //console.log("La clave es " + key + " y el valor es " + valor[key]);
		                        }

		                    }
		                    $("#mf_total").text(valor['total_ingreso']);;
		                    $("#g_total").text(valor['total_egreso']);;
		                }
		            }
		            $("#g_").replaceWith(tr_gastos);
		            $("#mf_").replaceWith(tr_facturado);

		        }
		    });

		}

		/**
		 * Guarda los montos y gastos mensuales
		 * del cliente
		 */
		function upData(name, objeto) {
		    console.log($(objeto).text());
		    var id = $("#id_cliente").val();
		    $.ajax({
		        type: "GET",
		        url: "./ajax/cliente/movimiento_cliente.php?accion=update&id=" + id + "&name=" + name + "&valor=" + $(objeto).text(),
		        beforeSend: function(objeto) {
		            //$("#resultados_ajax").html("Mensaje: Cargando...");
		        },
		        success: function(datos) {
		            movimientos(id);
		        }
		    });

		};




		$("#td").submit(function(event) {
		    $('#guardar_datos').attr("disabled", true);

		    var parametros = $(this).serialize();
		    $.ajax({
		        type: "POST",
		        url: "ajax/cliente/nuevo_cliente.php",
		        data: parametros,
		        beforeSend: function(objeto) {
		            $("#resultados_ajax").html("Mensaje: Cargando...");
		        },
		        success: function(datos) {
		            $("#resultados_ajax").html(datos);
		            $('#guardar_datos').attr("disabled", false);
		            load(1);
		        }
		    });
		    event.preventDefault();
		})