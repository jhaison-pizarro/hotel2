<script>

    $('body').on('click', '.btn_save_producto', function()
    {
        event.preventDefault();
        let nombre    = $('#nombre').val();
            precio    = $('#precio').val(),
            stock     = $('#stock').val(),
            categoria = $('#categoria').val(),
            fecha     = $('#fecha').val();

            if(nombre == ''  || precio == '' || categoria == '' || fecha == '' || stock == '')
            {
                toast_msg('Llena todos los datos', 'Peligro!', 'warning');
                return; 
            }
            if(categoria == 0)
            {
                toast_msg('Seleccione al menos una categoria', 'Peligro!', 'warning');
                $('#categoria').focus();
                return; 
            }
            $.ajax({
                     url     : "{{ route('save_producto') }}",
                     method  : 'POST',
                     data    : {
                                '_token'    : "{{ csrf_token() }}",
                                nombre      : nombre,
                                precio      : precio,
                                stock       : stock,
                                categoria   : categoria,
                                fecha       : fecha,

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
                        $('#registrar_productos').modal('hide');



                    },
                    dataType : 'json',

            })

       });

    $('body').on('click', '.btn-edit_producto', function(){
        event.preventDefault();
        let idproducto = $(this).data('id');
        $('.btn_edit_producto').val(idproducto);
        

       
        $.ajax({
            url     : "{{ route('edit_producto') }}",
            method  : 'POST',
            data    : {
                        '_token'    : "{{ csrf_token() }}",
                        idproducto         : idproducto,
                      },
            success : function(r)
            {
                if(!r.status)
                {
                    toast_msg('Intentelo nuevamente', 'Peligro!', 'error'); 
                    return;
                }
                $('#edit_nombre').val(r.producto.nombre);
                $('#edit_precio').val(r.producto.precio);
                $('#edit_stock').val(r.producto.stock);
                $('#edit_categoria').val(r.producto.idcategoria);
                $('#edit_fecha').val(r.producto.fecha);
                $('#edit_productos').modal('show');
            },
            dataType : 'json',
    });

})

$('body').on('click', '.btn_edit_producto', function(){
    var idproducto = $(this).val();
    let     nombre    = $('#edit_nombre').val();
            precio    = $('#edit_precio').val(),
            stock     = $('#edit_stock').val(),
            categoria = $('#edit_categoria').val(),
            fecha     = $('#edit_fecha').val();
            if(nombre == ''  || precio == '' || categoria == '' || fecha == '' || stock == '')
            {
                toast_msg('Llena todos los datos', 'Peligro!', 'warning');
                return; 
            }
            if(categoria == 0)
            {
                toast_msg('Seleccione al menos una categoria', 'Peligro!', 'warning');
                $('#edit_categoria').focus();
                return; 
            }
    
    $.ajax({

        url     : "{{ route('edit_save_producto') }}",
        method  : 'POST',
        data    : {
                    '_token'    : "{{ csrf_token() }}",
                    nombre      : nombre,
                    precio      : precio,
                    stock       : stock,
                    categoria   : categoria,
                    fecha       : fecha,
                    idproducto  : idproducto,
        },
        success : function(r)
        {
            if(!r.status)
            {
                toast_msg('Intentelo nuevamente', 'Peligro!', 'error'); 
                return;
            }
            toast_msg('Registro actualizado', 'Bien', 'success');
            $('#edit_productos').modal('hide');
            load_datatable();
        },
        dataType : 'json',
    })

});

$('body').on('click', '.btn_delete_producto', function(){

        let idproducto = $(this).data('id');
        $('.eliminar').val(idproducto);
        $('#modal_delete_producto').modal('show');
});

$('body').on('click', '.eliminar', function()
{
    event.preventDefault();
    let idproducto = $(this).val();

    $.ajax({

        url       :  "{{ route('delete_producto') }}",
        method    : 'POST',
        data      : {

            '_token'    : "{{ csrf_token() }}",
            idproducto : idproducto,
        },
        success   : function(r)
        {
            if(!r.status)
            {
              toast_msg('Intente nuevamente', 'Error!', 'error');
              return; 
            }
            toast_msg('Registro eliminado  correctamente','Bien!', 'success');
            load_datatable();
            $('#modal_delete_producto').modal('hide');

        },
        dataType  : 'json',
    })


   




});

</script>