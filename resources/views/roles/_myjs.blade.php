<script>
    function load_datatable()
    {
        let datatable = $('#table').DataTable({
            serverSide  :true,
            "paging"    :true,
            "searching" :true,
            "destroy"   :true,
            responsive  :true,
            ordering    :false,
            autoWidth   :false,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
            language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 Registros",
                "infoFiltered": "(Filtrado de _MAX_ total Registros)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Registros",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "ajax"      : "{{ route('table_roles') }}",
            "columns"   : [
                {
                    data        : 'id',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    className   : 'text-center'
                },
                {
                    data : 'descripcion', className : 'text-center'
                },
                {
                    data : 'estado', className : 'text-center'
                },
                {
                    data : 'acciones', className : 'text-center'                }
                

            
            ]
        });
    }
    load_datatable();

$('body').on('click', '.btn_save_roles', function(){

    let descripcion = $('#descripcion').val();
    if(descripcion == '')
    {
        toast_msg('Llene todos los campos', 'Pelgro!', 'warning');
        $('#nombre_cliente').focus();
        return;
    }
    $.ajax({

        url     : "{{ route('save_roles') }}",
        method  : 'POST',
        data    : {

            descripcion : descripcion,
            '_token'    : "{{ csrf_token() }}",
        },
        success : function(r)
        {
            if(!r.status)
            {
                toast_msg('Intente nuevamente', 'Pelgro', 'warning');
                return;
            }
            toast_msg('Registro insertado', 'Bien', 'success');
            $('#nuevorol').modal('hide');
            load_datatable();   

        },
        dataType: 'json'
    })
});


$('body').on('click', '.btn-edit_roles', function(){
    let id = $(this).data('id');
    $('.btn_edit_roles').val(id);
    $.ajax({

        url   : "{{ route('edit_rol') }}",
        method: 'POST',
        data  : {
            id : id,
            '_token'    : "{{ csrf_token() }}",
        },
        success : function(r)
        {
            if(!r.status)
            {
                toast_msg('Intente nuevamente', 'Eror!', 'error');
                return; 
            }
            $('#edit_descripcion').val(r.rol.descripcion);
            $('#editrol').modal('show');
        },
        dataType : 'json'

    })
});

$('body').on('click', '.btn_edit_roles', function(){
    let id = $(this).val();
   
        descripcion = $('#edit_descripcion').val();
        if(descripcion == '')
        {
            toast_msg('Llene todos los campos', 'Peligro', 'warning');
            $('#edit_descripcion').focus();
            return;   
        }
        $.ajax({
            
            url : "{{ route('update_rol')}}",
            method: 'POST',
            data   : {
            id : id,
            descripcion: descripcion,
            '_token'    : "{{ csrf_token() }}",
            },
            success : function(r)
            {
                if(!r.status)
                {
                    toast_msg('Intente nuevamente', 'Error', 'danger');
                    return;  
                }
                toast_msg('Regitro actualizado', 'Bien', 'success');
                $('#editrol').modal('hide');
                load_datatable();   

            },
            dataType: 'json'
        })

})

$('body').on('click', '.btn_delete_roles', function(){

    let id = $(this).data('id')
    console.log(id);
    $('.btn_confirmar_delete').val(id);
    $('#modal_delete_rol').modal('show');
   
})
$('body').on('click', '.btn_confirmar_delete', function(){

    let id = $(this).val();
    $.ajax({
        url  : "{{ route('delete_rol')}}",
        method: 'POST',
        data : { id: id,
            '_token'    : "{{ csrf_token() }}",
        },
        success: function(r)
        {
            if(!r.status)
            {
                toast_msg('Intente nuevamente', 'Error', 'danger');
                return;  
            }
            toast_msg('Regitro eliminado', 'Bien', 'success');
            $('#modal_delete_rol').modal('hide');
            load_datatable();   
        },
        dataType: 'json'

    })
})
</script>