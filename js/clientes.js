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
		            $.each(data, function(i, item) {
		                if (item.movimiento === 'ingresos') {
		                    $("#mf_enero").text(item.enero);
		                    $("#mf_febrero").text(item.febrero);
		                    $("#mf_marzo").text(item.marzo);
		                    $("#mf_abril").text(item.abril);
		                    $("#mf_mayo").text(item.mayo);
		                    $("#mf_junio").text(item.junio);
		                    $("#mf_julio").text(item.julio);
		                    $("#mf_agosto").text(item.agosto);
		                    $("#mf_septiembre").text(item.septiembre);
		                    $("#mf_octubre").text(item.octubre);
		                    $("#mf_noviembre").text(item.noviembre);
		                    $("#mf_diciembre").text(item.diciembre);
		                    var mf_total =

		                        (parseFloat(item.enero) +
		                            parseFloat(item.febrero) +
		                            parseFloat(item.marzo) +
		                            parseFloat(item.abril) +
		                            parseFloat(item.mayo) +
		                            parseFloat(item.junio) +
		                            parseFloat(item.julio) +
		                            parseFloat(item.agosto) +
		                            parseFloat(item.septiembre) +
		                            parseFloat(item.octubre) +
		                            parseFloat(item.noviembre) +
		                            parseFloat(item.diciembre));
		                    $("#mf_total").text(String(mf_total.toFixed(2)));
		                } else {
		                    $("#g_enero").text(item.enero);
		                    $("#g_febrero").text(item.febrero);
		                    $("#g_marzo").text(item.marzo);
		                    $("#g_abril").text(item.abril);
		                    $("#g_mayo").text(item.mayo);
		                    $("#g_junio").text(item.junio);
		                    $("#g_julio").text(item.julio);
		                    $("#g_agosto").text(item.agosto);
		                    $("#g_septiembre").text(item.septiembre);
		                    $("#g_octubre").text(item.octubre);
		                    $("#g_noviembre").text(item.noviembre);
		                    $("#g_diciembre").text(item.diciembre);


		                    var g_total =

		                        (parseFloat(item.enero) +
		                            parseFloat(item.febrero) +
		                            parseFloat(item.marzo) +
		                            parseFloat(item.abril) +
		                            parseFloat(item.mayo) +
		                            parseFloat(item.junio) +
		                            parseFloat(item.julio) +
		                            parseFloat(item.agosto) +
		                            parseFloat(item.septiembre) +
		                            parseFloat(item.octubre) +
		                            parseFloat(item.noviembre) +
		                            parseFloat(item.diciembre));
		                    $("#g_total").text(String(g_total.toFixed(2)));

		                }
		            });
		            var total_general = (parseFloat(mf_total) - parseFloat(g_total));

		            console.log(g_total);

		            $("#total_general").text(String(total_general));
		        }
		    });

		}

		/**
		 * Guarda los montos y gastos mensuales
		 * del cliente
		 */
		$("td").focusout(function() {
		    var id = $("#id_cliente").val();
		    console.log(id);
		    $.ajax({
		        type: "GET",
		        url: "./ajax/cliente/movimiento_cliente.php?accion=update&id=" + id + "&name=" + $(this)[0].id + "&valor=" +
		            $(this).text(),
		        beforeSend: function(objeto) {
		            //$("#resultados_ajax").html("Mensaje: Cargando...");
		        },
		        success: function(datos) {
		            movimientos(id);
		        }
		    });

		});




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