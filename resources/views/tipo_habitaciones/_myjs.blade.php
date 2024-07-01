<script>

$('body').on('click', '.btn_save_tipo_habitacion', function()
{
    event.preventDefault();
    let denominacion = $('#denominacion_tipo').val();
        descripcion = $('#descripcion_tipo').val();

     if(denominacion == ''  || descripcion == '')
     {
        toast_msg('Llena todos los datos', 'Peligro!', 'warning');
        return; 
     }
     $.ajax({

        url       :   "{{ route('save_tipo_habitacion') }}",
        method    : 'POST',
        data      : {
                        '_token'    : "{{ csrf_token() }}",
                        denominacion: denominacion,
                        descripcion : descripcion
                    },
        success : function(r)
        {
            if(!r.status)
            {
                toast_msg('Intentelo nuevamente', 'Peligro!', 'error'); 
                return; 
            }
            toast_msg('Registro insertado correctamente', 'Bien!', 'success'); 
            load_datatable(); 
            $('#registrar_tipo_hab').modal('hide');
        },
        dataType : 'json',

     })
});

$('body').on('click', '.btn-edit_tipo_habitacion', function()
{
   event.preventDefault();
   let idtipo = $(this).data('id');
   $.ajax({

            url    :  "{{ route('edit_tipo_habitacion') }}",
            method :  'POST',
            data   : {
                   
                '_token'    : "{{ csrf_token() }}",
                idtipo      : idtipo
            },
        success: function(r)
        {
            if(!r.status)
            {
                toast_msg('Intente nuevamente', 'Error!', 'error')
                return;   
            }
            $('#edit_denominacion_tipo').val(r.edit_tipo.denominacion);
            $('#edit_descripcion_tipo').val(r.edit_tipo.descripcion);
            $('#idtipo').val(r.edit_tipo.idtipo);
            $('#edit_tipo_hab').modal('show');
        },
        dataType : 'json'
    
   })


});

$('body').on('click', '.btn_edit_tipo_habitacion', function()
{
   event.preventDefault();
   let denominacion  = $('#edit_denominacion_tipo').val();
    descripcion      = $('#edit_descripcion_tipo').val(),
    idtipo           = $('#idtipo').val();
    if(denominacion == ''  || descripcion == '')
     {
        toast_msg('Llena todos los datos', 'Peligro!', 'warning');
        return; 
     }
    $.ajax({
                 
            url    : "{{ route('update_tipo_habitacion') }}",
            method : 'POST',
            data   : {
                '_token'    : "{{ csrf_token() }}",
                idtipo      : idtipo,
                denominacion: denominacion,
                descripcion : descripcion,
            },
        success: function (r)
        {
            if(!r.status)
            {
                toast_msg('Intente nuevamente', 'Error!', 'error')
                return;   
            }
            toast_msg('Registro actulizado correctamente', 'Bien!', 'success'); 
            load_datatable(); 
            $('#edit_tipo_hab').modal('hide');
        },
        dataType : 'json',

    })
});

$('body').on('click', '.btn_delete_tipohabitacion', function()
{
    event.preventDefault();
    let idtipo  = $(this).data('id');
     $('.btn_confirmar_delete').val(idtipo);
     $('#modal_delete_tipo_hab').modal('show');
   
});

$('body').on('click', '.btn_confirmar_delete', function()
{
    event.preventDefault();
    let idtipo = $(this).val();
    $.ajax({
         
            url    : "{{ route('delete_tipo_habitacion') }}",
            method : 'POST',
            data   : {
                '_token'    : "{{ csrf_token() }}",
                idtipo : idtipo,
            },
            success : function(r)
            {
                if(!r.status)
                {
                    toast_msg('Intente nuevamente', 'Error!', 'error');
                    return; 
                }
                
                toast_msg('Registro eliminado  correctamente','Bien!', 'success');
                load_datatable();
                $('#modal_delete_tipo_hab').modal('hide');


            },
            dataType : 'json',

    })
})
</script>