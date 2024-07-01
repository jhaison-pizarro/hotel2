<script>
 $('body').on('click', '.btn_save_usuarios', function(e) {
    event.preventDefault();
    var nombre      = $('#nombre').val();
        documento   = $('#documento').val();
        telefono    = $('#telefono').val();
        direccion   = $('#direccion').val();
        usuario     = $('#usuario').val();
        contraseña  = $('#contraseña').val();
        idrol       = $('#rol').val();
        if(nombre == ''  || documento == '' || telefono == '' || direccion == '' || usuario == '' || contraseña == '' || rol == '')
        {
            toast_msg('Llena todos los datos', 'Peligro!', 'warning');
            return; 
        }
        if(documento.length != '8')
        {
            toast_msg('DNI incorrecto', 'Peligro!', 'warning');
            $('#documento').focus();
            return;
        }
        $.ajax({

                url    : "{{ route('save_usuarios') }}",
                method : 'POST',
                data   : { '_token'    : "{{ csrf_token() }}", 
                            nombre    : nombre,
                            telefono  : telefono,
                            direccion : direccion,
                            documento : documento,
                            usuario   : usuario,
                            contraseña: contraseña,
                            idrol     : idrol
                         },
                success : function(r)
                {
                   if(!r.status)
                   {
                    toast_msg('Intente nuevamente', 'Eror!', 'error');
                    return;
                   } 
                   toast_msg('Registro insertado correctamente', 'Bien!', 'success');
                   load_datatable();
                   $("#registrar_usuario").modal('hide'); 
                   limpiar_formulario();
                   
                }, 
                dataType : 'json',


        });
            
});

 function limpiar_formulario()
 {
        nombre      = $('#nombre').val('');
        documento   = $('#documento').val('');
        telefono    = $('#telefono').val('');
        direccion   = $('#direccion').val('');
        usuario     = $('#usuario').val('');
        contraseña  = $('#contraseña').val('');
 }

 //MOSTRAR DATOS EDIT
$('body').on('click', '.btn-edit_usuario', function()
{
    let idusuario = $(this).data('id');
    $.ajax({

            url : "{{ route('edit_usuario') }}",
            method : 'POST',
            data   :{
                '_token'    : "{{ csrf_token() }}",
                    id:idusuario},
        success: function(r)
        {
            if(!r.status)
            {
                toast_msg('Intente nuevamente', 'Eror!', 'error');
                return;
            }
           
            $('#edit_nombre').val(r.usuario.nombre)
            $('#edit_direccion').val(r.usuario.direccion);
            $('#edit_documento').val(r.usuario.documento);
            $('#edit_telefono').val(r.usuario.telefono);
            $('#edit_usuario').val(r.usuario.usuario);
            $('#edit_contraseña').val(r.usuario.contraseña);
            $('#idusuario').val(r.usuario.idusuario);
            $('#idrol').val(r.usuario.idrol);
            $('#edit_form_usuarios').modal('show');
    
            
        },
        dataType : 'json',          


    })

});

//UPDATE 

$('body').on('click', '.btn_update_usuario', function()
{
    
let nombre    = $('#edit_nombre').val(),
    documento = $('#edit_documento').val(),
    telefono  = $('#edit_telefono').val(),
    direccion = $('#edit_direccion').val(),
    usuario   = $('#edit_usuario').val(),
    contraseña= $('#edit_contraseña').val(),
    idusuario = $('#idusuario').val();
    idrol     = $('#idrol').val();

    if(nombre == ''  || documento == '' || telefono == '' || direccion == '' || usuario == '' || contraseña == '' || idrol == '')
    {
        toast_msg('Llena todos los datos', 'Peligro!', 'warning');
        return; 
    }
    if(documento.length != '8')
    {
        toast_msg('DNI incorrecto', 'Peligro!', 'warning');
        $('#documento').focus();
        return;
    }
    $.ajax({

            url    : "{{ route('update_usuario') }}",
            method : 'POST',
            data   : {
                '_token'    : "{{ csrf_token() }}",
                      
                      nombre     : nombre,
                      documento  : documento,
                      telefono   : telefono,
                      direccion  : direccion,
                      usuario    : usuario,
                      contraseña : contraseña,
                      idusuario  : idusuario,
                      idrol      : idrol
                     },
            success : function (r)
            {
               if(!r.status)
               {
                toast_msg('Intente nuevamente', 'Eror!', 'error');
                return;
               }
               toast_msg('Registro actualizado correctamente', 'Bien!', 'success');
               load_datatable();
               $('#edit_form_usuarios').modal('hide');

            },
            dataType : 'json',          



    })


});

//DELETE
$('body').on('click', '.btn_delete_usuario', function()
{   
    event.preventDefault();
    let id = $(this).data('id');
    $('.btn_confirmar_usuario').val(id);
    $('#modal_delete_usuario').modal('show');
});

$('body').on('click', '.btn_confirmar_usuario', function()
{
    event.preventDefault();
    let id = $(this).val();
    $.ajax({
          url    :  "{{ route('delete_usuarios') }}",
          method : 'POST',
          data   : {  '_token'    : "{{ csrf_token() }}",
                     id : id},
          success : function(r)
          {
            if(!r.status)
            {
                toast_msg('Intente nuevamente', 'Eror!', 'error');
                return;     
            }
            toast_msg('Registro actualizado correctamente', 'Bien!', 'success');
            load_datatable();
            $('#modal_delete_usuario').modal('hide');
          },
          dataType : 'json',


    })
});
</script>