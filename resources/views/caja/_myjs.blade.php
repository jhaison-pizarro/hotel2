<script>

    $('body').on('click', '.btn-apertura', function(){

        event.preventDefault();
        let fecha = $('#fecha_apertura').val();
            hora  = $('#hora_apertura').val();
            monto = $('#monto_apertura').val();

        if(monto == '')
        {
            toast_msg('Ingresar un monto valido', 'Peligro', 'warning');
            return;
        }
        $.ajax({

            url     :  "{{ route('apertura.save') }}",
            method  : 'POST',
            data    : {fecha: fecha, hora: hora, monto: monto,  '_token': "{{ csrf_token() }}"},
          
            success : function(r)
            {
                if(!r.status)
                {
                    toast_msg('Intente nuevamente', 'Error', 'error');
                    return;
                }

                toast_msg('Registro insertado', 'Bien', 'success');
                $('#monto_apertura').val('');
                load_datatable();
               
            },
            dataType: 'json',
        })

    })

    $('body').on('click', '.btn_cerrar_caja', function(e) {

        e.preventDefault();
        let id = $(this).data('id');
        $('.btn_confirmar').val(id);
        $('#modal_cerrar_caja').modal('show');

    });

    $('body').on('click', '.btn_confirmar', function(e) {
         e.preventDefault();
        let id = $(this).val();
    
        $.ajax({

            url     :  "{{ route('caja.cerrar') }}",
            method  : 'POST',
            data    : {id: id,  '_token': "{{ csrf_token() }}"},
            success : function(r)
            {
                if(!r.status)
                {
                    toast_msg('Intente nuevamente', 'Error', 'error');
                    return;
                }
                $('#modal_cerrar_caja').modal('hide');

                toast_msg('Caja cerrada', 'Bien','success');
                load_datatable();

            },
            dataType: 'json',

        })

    });

</script>