<script>

    $('body').on('click', '.btn_save_habitacion', function(r)
    {
        event.preventDefault();
        let nro_habitacion  = $('#nro_habitacion').val();
            precio          = $('#precio_habitacion').val();
            nivel           = $('#nivel_habitacion').val();
            tipo            = $('#tipo_habitacion').val();
            descripcion_hab = $('#descripcion_hab').val();
           
         
            if(nro_habitacion == ''  || precio == '' || nivel == '' || tipo == ''  || descripcion_hab == '')
            {
                toast_msg('Llena todos los datos', 'Peligro!', 'warning');
                return; 
            }
            $.ajax({

                    url     : "{{ route('save_habitaciones')  }}",
                    method : 'POST',
                    data   : {
                        '_token'    : "{{ csrf_token() }}",
                        nro_habitacion      : nro_habitacion,
                        precio      : precio,
                        nivel       : nivel,
                        tipo        : tipo,
                        descripcion_hab: descripcion_hab
                             
                    },
                success : function (r)
                {
                    if(!r.status)
                    {
                        toast_msg('Intentelo nuevamente', 'Peligro!', 'error'); 
                        return;
                    }
                    toast_msg('Registro insertado correctamente', 'Bien!', 'success'); 
                    load_datatable();  
                    $('#registrar_habitaciones').modal('hide');
                },
                dataType : 'json',
            })

    })

</script>