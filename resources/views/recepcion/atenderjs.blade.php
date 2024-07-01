<script>
    var totalOriginal = document.getElementById('precio').value
    function calcularPrecio() {

    const entradaDate = new Date(document.getElementById('entrada').value);
    const salidaDate = new Date(document.getElementById('salidas').value);

    if (salidaDate < entradaDate) {
        toast_msg('La fecha de salida debe ser posterior a la fecha de entrada', 'Error!', 'error');
        $('#salidas').val('');
        return;
    }
    const oneDay = 24 * 60 * 60 * 1000; // Milisegundos en un día
    const dias = Math.round(Math.abs((salidaDate.getTime() - entradaDate.getTime()) / oneDay));
    const precioAlto = document.getElementById('precio').value;
    const monto = precioAlto
    precioTotal = dias * parseInt(monto);
    if(isNaN(precioTotal))
    {
        
    }
    else{
        document.getElementById('precio').value = precioTotal+'.00';
        
    }
  
    

}
calcularPrecio();

$('body').on('click', '.btn_save_recepcion', function()
{
    if($('#dni_ruc').val() == '')
        {
            toast_msg('Ingrese un DNI valido', 'Peligro!', 'warning');
            $('#dni_ruc').focus();
            return;
        }

        let idcliente       = $(this).val();
        entrada             = $('#entrada').val(),
        salida              = $('#salidas').val(),
        precio              = $('#precio').val(),
        adelanto            = $('#adelanto').val(),
        observaciones       = $('#observaciones').val(),
        idhabitacion        = "<?php echo  $habitaciones->idhabitacion ?>";
        if(idcliente == '')
        {
            toast_msg('Ingrese un DNI valido', 'Peligro', 'warning');
            $('#dni_reservar').focus();
            return;
        }
        if(salida == '' )
        {
            toast_msg('Ingrese una salida valida', 'Peligro', 'warning');
            $('#salida').focus();
            return; 
        }
       
        Swal.fire({
            title: "Desea registrar esta habitacion?",
            showDenyButton: true,
          
            confirmButtonText: "Guadar",
            denyButtonText: `Cancelar`
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({

                    url    : "{{ route('save_resepcion') }}",
                    method : 'POST',
                    data   :

                    {
                        '_token'    : "{{ csrf_token() }}", 
                        idcliente   : idcliente,
                        entrada     : entrada,
                        salida      : salida,      
                        adelanto    : adelanto,    
                        precio      : precio, 
                        observaciones : observaciones,
                        idhabitacion : idhabitacion, 
                        
                        //dattos cliente
                        dni             : $('#dni_cli').val(),
                        idtipo_documento: $('#tipo_documento').val(),
                        nombre          : $('#nombre_cli').val(),
                        apellido        : $('#apellido_cliente').val(),
                        telefono        : $('#telefono_cliente').val(),
                        email           : $('#correo_cliente').val(),
                       


                    }, 
                    success : function(r)
                    {
                        if(!r.status)
                        {
                            toast_msg('Intente nuevamente', 'Pelgro!', 'error');
                            return;
                        }
                        setTimeout(function() {
                            window.location.href = "{{ url('recepcion') }}"; 
                        }, 3000); 
                       
                    }, 
                    dataType : 'json',

                    })
                  Swal.fire("Habitacion registrada", "", "success");
                  setTimeout(function() {
                            window.location.href = "{{ url('recepcion') }}"; 
                        }, 1000);


            } else if (result.isDenied) {
                Swal.fire("Cancelado", "", "info");
            }
            });
    
       
});

$('#dni_cli').autocomplete({

    minLength : 1,
    source: function(request, response)
    {
       $.ajax({

            url     : "{{ route('buscardni') }}",
            dataType: 'json',
            data    : { valor : request.term},
            success: function(data)
            {
                response(data);
            }

       });
    },
    select: function(event, ui)
    {
        $('input[name="dni_cli"]').val(ui.item.idcliente);
        $('#nombre_cliente').val(ui.item.nombre)
        $('#apellido_cliente').val(ui.item.apellido)
        $('#correo_cliente').val(ui.item.email)
        $('#telefono_cliente').val(ui.item.telefono)
        $('.btn_save_recepcion').val(ui.item.idcliente);

        if(ui.item.dni.Length = '8')
        {
            $('#tipo_documento').val('1')
        }
    }

});



</script>