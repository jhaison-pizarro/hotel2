<script>

$('body').on('click', '.btn_reniec_re', function()
    {
        event.preventDefault();
        let dni_ruc = $('#dni_cli_re').val();
        $.ajax({
            url   : "{{ route('btn_reniec_cli')}}",
            method : 'POST',
            beforeSend : function(){
                $('.btn_reniec_re').prop('disabled', true);
                $('.btn_reniec_re').addClass('d-none');
                $('.btn_reniec_disable_re').removeClass('d-none');
            },
            data  : {
                '_token': "{{ csrf_token() }}",
                dni_ruc : dni_ruc
            },
            success : function(r)
            {
                if(!r.status) {
                    $('.btn_reniec_re').prop('disabled', false);
                    $('.btn_reniec_re').removeClass('d-none');
                    $('.btn_reniec_disable_re').addClass('d-none');
                    toast_msg('Intento nuevamente', 'Erro', 'error');
                    return;
                }

                $('.btn_reniec_re').prop('disabled', false);
                $('.btn_reniec_re').removeClass('d-none');
                $('.btn_reniec_disable_re').addClass('d-none');
                $('#nombre_cliente_re').val(r.nombres)
                $('#apellido_cliente_re').val(r.apellidos)
                if(r.numero.Length = '8')
                {
                    $('#tipo_documento_re').val('1')
                }
                
            },
            dataType: 'json',
        })

});


$('body').on('click', '.btn_save_cliente', function(r)
{
    let nombre   = $('#nombre_cliente_re').val();
        apellido = $('#apellido_cliente_re').val(),
        tipo_doc = $('#tipo_documento_re').val(),
        dni      = $('#dni_cli_re').val(),
        correo   = $('#correo_cliente_re').val(),
        telefono = $('#telefono_cliente_re').val();
       
    if(nombre == '')
    {
        toast_msg('Llene todos los campos', 'Pelgro!', 'warning');
        $('#nombre_cliente').focus();
        return;
    }
    if(apellido == '')
    {
        toast_msg('Llene todos los campos', 'Pelgro!', 'warning');
        $('#apellido_cliente').focus();
        return;
    }
   if(correo == '')
    {
        toast_msg('Llene todos los campos', 'Pelgro!', 'warning');
        $('#correo_cliente').focus();
        return;
    }
    if(telefono == '')
    {
        toast_msg('Llene todos los campos', 'Pelgro!', 'warning');
        $('#telefono_cliente').focus();
        return;
    }
    $.ajax({

        url     : "{{ route('save_cliente') }}",
        method  : 'POST',
        data    : {
            '_token'    : "{{ csrf_token() }}",
                nombre  : nombre,
                apellido : apellido,
                dni      : dni,
                correo   : correo,
                telefono : telefono,
                tipo_doc : tipo_doc,
             

             }, 
        success : function(r)
        {
            if(!r.status)
            {
                toast_msg('Intente nuevamente', 'Pelgro!', 'error');
                return;
            }
            toast_msg('Registro insertado correctamente', 'Bien!', 'success');
            $('#registrar_cliente').modal('hide');
            load_datatable(); 
            limpiar_formulario();
        },
        dataType : 'json',
    })

});

//EDITAR CLIENTES

$('body').on('click', '.btn-edit_cliente', function()
{
    let idcliente = $(this).data('id');
    $.ajax({

        url    : "{{ route('edit_cliente') }}",
        method : 'POST',
        data   : {
            '_token'    : "{{ csrf_token() }}",
            idcliente : idcliente
        },
        success : function(r)
        {
            if(!r.status)
            {
                toast_msg('Intente nuevamente', 'Error!', 'error')
                 return;

            }
           $('#edit_dni_cli').val(r.clientes.dni),
           $('#edit_cliente_nombre').val(r.clientes.nombre),
           $('#edit_apellido_cliente').val(r.clientes.apellido),
           $('#edit_tipo_documento').val(r.clientes.idtipo_documento),
           $('#edit_dni_cliente').val(r.clientes.dni),
           $('#edit_correo_cliente').val(r.clientes.correo),
           $('#edit_telefono_cliente').val(r.clientes.telefono),
           $('.btn_edit_cliente').val(r.clientes.idcliente),
           $('#edit_cliente').modal('show');         
        },
        dataType : 'json',


    })
});

$('body').on('click', '.btn_edit_cliente', function()
{
    let nombre      = $('#edit_cliente_nombre').val();
        apellido    = $('#edit_apellido_cliente').val(),
        idtipo_doc  = $('#edit_tipo_documento').val(),
        dni         = $('#edit_dni_cliente').val(),
        correo      = $('#edit_correo_cliente').val(),
        telefono    = $('#edit_telefono_cliente').val(),
        idcliente   = $(this).val();

    if(nombre == '')
    {
        toast_msg('Llene todos los campos', 'Pelgro!', 'warning');
        $('#edit_cliente_nombre').focus();
        return;
    }
    if(apellido == '')
    {
        toast_msg('Llene todos los campos', 'Pelgro!', 'warning');
        $('#edit_apellido_cliente').focus();
        return;
    }
    
    if(correo == '')
    {
        toast_msg('Llene todos los campos', 'Pelgro!', 'warning');
        $('#edit_correo_cliente').focus();
        return;
    }
    if(telefono == '')
    {
        toast_msg('Llene todos los campos', 'Pelgro!', 'warning');
        $('#edit_telefono_cliente').focus();
        return;
    }
    
    $.ajax({

        url    : "{{ route('save_edit_clientes') }}",
        method : 'POST',
        data   : {
            '_token'    : "{{ csrf_token() }}",
            nombre      : nombre,
            apellido    : apellido,
            idtipo_doc  : idtipo_doc,     
            dni         : dni,
            correo      : correo,
            telefono    : telefono,
            idcliente   : idcliente,
        },
        success : function(r){
            if(!r.status)
            {
                toast_msg('Intente nuevamente', 'Error!', 'error');
                return;  
            }
            toast_msg('Registro actualizado  correctamente','Bien!', 'success');
            load_datatable();
            $('#edit_cliente').modal('hide');

        },dataType : 'json'


    })

       
});

//ELIMINAR CLIENTE 

$('body').on('click', '.btn-delete_cliente', function(r)
{
        let idcliente = $(this).data('id');
        $('.btn_delete_cliente').val(idcliente);
        $('#modal_delete_cliente').modal('show');    
});

$('body').on('click', '.btn_delete_cliente', function()
{
    let idcliente = $(this).val();
    $.ajax({

            url      : "{{ route('delete_cliente') }}",
            method   : 'POST',
            data     : {
                '_token'    : "{{ csrf_token() }}",
                idcliente   : idcliente,

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
                $('#modal_delete_cliente').modal('hide');
            },
            dataType : 'json',

    })
});




//Limpir formulario save cliente

function limpiar_formulario()
{
    $('#nombre_cliente').val('');
    $('#apellido_cliente').val(''),
    $('#tipo_documento').val(''),
    $('#dni_cliente').val(''),
    $('#correo_cliente').val(''),
    $('#telefono_cliente').val(''),
    $('#direccion_cliente').val('');
}

</script>