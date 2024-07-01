<script>

   //Variables globales

  

    $('#productos').autocomplete({

        minLength: 1,
        source : function (request, response)
        {
            $.ajax({

                url     : "{{ route('buscarproducto') }}",
                dataType: 'json',
                data    : { valor : request.term},
                success: function(data)
                {
                    response(data);
                }

                });
        },
        select: function (event, ui)
        {
            $('input[name="precio_producto"]').val(ui.item.precio);
            $('input[name="idproducto"]').val(ui.item.idproducto);
        }


    });

    $('body').on('click', '.btn_agregar_producto', function(e) {
    e.preventDefault();
    var estado = $('input[name="ventass"]:checked').val();
    var html='';

    if ($("#productos").val() == '') {
        toast_msg('Ingrese al menos un producto', 'Peligro', 'warning');
        $("#productos").focus();
        return;
    }

    if ($("#cantidad_producto").val() == '') {
        toast_msg('Ingrese la cantidad', 'Peligro', 'warning');
        $("#cantidad_producto").focus();
        return;
    }

    if (estado == undefined) {
        toast_msg('Ingresar el pago', 'Peligro', 'warning');
        return;
    }

    var producto = $("#productos").val();
    var idproducto = $("#idproducto").val();
    var precio = parseFloat($("#precio_producto").val()).toFixed(2);
    var cantidad = parseInt($("#cantidad_producto").val());

    verstock(idproducto, cantidad, function(stockDisponible) {
        if (stockDisponible) {
            if (estado == 1) {
                html = '<td class="badge badge-success text-center">PAGADO</td>';
            } else {
                html = '<td class="badge badge-danger text-center">PENDIENTE</td>';
            }

            var subtotal = parseFloat(cantidad * precio).toFixed(2);

            $('.tbody_productos').append(`<tr>
                <td class="d-none">${idproducto}</td>
                <td class="text-center">${producto}</td>
                <td class="text-center">${cantidad}</td>
                <td class="text-center">${precio}</td>
                ${html}
                <td class="subtotal text-center">${subtotal}</td>
                <td class="d_opci text-center"><a class="mr-1 text-danger td_producto" style="font-size: 18px" data-toggle="tooltip" title="Eliminar producto"><i class="fa fa-trash"></i></a></td>
            </tr>`);

            $("#productos").val('');
            $("#idproducto").val('');
            $("#precio_producto").val('');
            $("#cantidad_producto").val('');

            var total = 0;
            $('.subtotal').each(function() {
                total += parseFloat($(this).text());
            });
            $('#total_operacion').val(total.toFixed(2));
        } else {
            toast_msg('No hay suficiente stock de este producto', 'Error', 'error');
        }
    });
});

function verstock(idproducto, cantidad, callback) {
    $.ajax({
        url: "{{ route('verstock') }}",
        method: 'POST',
        data: {
            '_token': "{{ csrf_token() }}",
            cantidad: cantidad,
            idproducto: idproducto
        },
        success: function(r) {
            if (!r.status) {
                callback(false);
            } else {
                callback(true);
            }
        },
        dataType: 'json'
    });
}

$('body').on('click', '.td_producto', function(e) {
    
    var subtotalProducto = parseFloat($(this).closest('tr').find('.subtotal').text());
    var totalActual = parseFloat($('#total_operacion').val());
    var nuevoTotal = totalActual - subtotalProducto;
    $('#total_operacion').val(nuevoTotal.toFixed(2));
    $(this).closest('tr').remove();
    toast_msg('Producto eliminado', 'Bien', 'success');
});

//Recojo de datos de la tabla 
function tbody_productos(){
			var finalArray = [];
			$('.tbody_productos').each(function(index, element){
				var TableArray = [];
				$(element).find("tr").each(function(){
					var arrayOfThisRow = [];
					var tableData = $(this).find('td');
					if (tableData.length > 0) {
								tableData.each(function () {
									arrayOfThisRow.push($(this).text());
								});
								TableArray.push(arrayOfThisRow);
							}
				});
				finalArray.push(TableArray);
			});
		return JSON.stringify(finalArray);
} 



$('body').on('click', '.btn_vender_producto', function(e) {
    e.preventDefault();
    var idreservacion = $(this).data('id');
    var numero = $(this).data('numero');
    var tabla_productos = tbody_productos();
    if(tabla_productos.length == 4)
    {
        toast_msg('No hay productos agregados a la tabla', 'Peligro', 'error');
        return;
    }
    Swal.fire({
            title: "Desea registrar esta venta?",
            showDenyButton: true,
          
            confirmButtonText: "Confirmar",
            denyButtonText: `Cancelar`
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url     : "{{ route('vender_save') }}",
                    type    : 'POST',
                    dataType: 'json',
                    data    : { idreservacion   : idreservacion,
                                tabla_productos : tabla_productos,
                                '_token' : "{{ csrf_token() }}",
                            },
                    success: function(r)
                    {
                        if (!r.status) {
                        
                        }
                        var mensaje = `Ventas registrada a la habitacion N° ${numero}`;
                        Swal.fire(mensaje, "", "success");
                        setTimeout(function() {
                            window.location.href = "{{ url('index_ventas') }}";
                          
                        }, 2000);


                    }, 
                    dataType: 'json',
                })

        }else if(result.isDenied){
            Swal.fire("Cancelado", "", "info");
        }
    });

    

});
</script>