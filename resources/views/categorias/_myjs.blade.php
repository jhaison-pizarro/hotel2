<script>

$('body').on('click', '.btn_categoria_save', function(){
    event.preventDefault();
    let denominacion = $('#denominacion').val();
    if(denominacion == '')
    {
        toast_msg('Llene todos los campos','Peligro!', 'warning');
        return;
    }
    $.ajax({

            url     : "{{ route('save_categoria') }}",
            method : 'POST',
            data   : {
                '_token'    : "{{ csrf_token() }}",
                denominacion : denominacion},
            success : function(r)
            {
                if(!r.status)
                {
                    toast_msg('Intente nuevamente','Erroe!', 'error');
                    return;
                }
                toast_msg('Registros insertado correctamente','Bien!', 'success');
                load_datatable();
                $('#registrar_categoria').modal('hide');
            },
            dataType : 'json',
    })

});

$('body').on('click', '.btn-edit_categoria', function()
{
    let id = $(this).data('id');
    $.ajax({

        url    : "{{ route('edit_categoria') }}",
        method : 'POST',
        data   : {
                '_token'    : "{{ csrf_token() }}",
                id : id},
        success : function(r)
        {
            if(!r.status)
            {
                toast_msg('Intente nuevamente','Erroe!', 'error');
                return;
            }
            $('#edit_denominacion').val(r.categoria.denominacion);
            $('#edit_idcategoria').val(r.categoria.idcategoria);
            $('#edit_form_categoria').modal('show');

        },
        dataType : 'json',

    })
});

$('body').on('click', '.btn_update_categoria', function()
{
    let denominacion = $('#edit_denominacion').val();
        idcategoria  =  $('#edit_idcategoria').val();

    if(denominacion == '')
    {
        toast_msg('LLene todos los campos', 'Peligro!', 'warning');
        return;
    }
    $.ajax({

        url     : "{{ route('update_categoria') }}",
        method  : 'POST',
        data    : {
                '_token'    : "{{ csrf_token() }}",
                denominacion : denominacion,
                idcategoria  : idcategoria},
        success : function(r)
        {
            if(!r.status)
            {
                toast_msg('Intente nuevamente', 'Error!', 'error');
                return;
            }
            toast_msg('Registros actualizado correctamente','Bien!', 'success');
            load_datatable();
            $('#edit_form_categoria').modal('hide');

        },
        dataType : 'json',
    })
});

$('body').on('click', '.btn_delete_categoria', function()
{
    let idcategoria = $(this).data('id');
    $('.btn_confirmar_usuario').val(idcategoria);
    $('#modal_delete_categoria').modal('show');
});

$('body').on('click', '.btn_confirmar_usuario', function()
{
    event.preventDefault();
    let idcategoria = $(this).val();
    $.ajax({

            url    : "{{ route('delete_categoria') }}",
            method : 'POST',
            data   : {
                '_token'    : "{{ csrf_token() }}",
                idcategoria : idcategoria,
            },
            success : function(r)
            {
                if(!r.status)
                {
                    toast_msg('Intente nuevamente', 'Error!', 'error');
                    return; 
                }
                
                toast_msg('Registros actualizado correctamente','Bien!', 'success');
                load_datatable();
                $('#modal_delete_categoria').modal('hide');


            },
            dataType : 'json',
    })
     
})
</script>