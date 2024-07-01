<script>
    $('body').on('click', '.btn_save_empresa', function()
    {
        event.preventDefault();

        let nombre        = $('#nombre_empresa').val(),
            direccion     = $('#direccion_empresa').val(),
            telefono      = $('#telefono_empresa').val(),
            email_empresa = $('#email_empresa').val(),
            ruc_empresa   = $('#ruc_empresa').val(),
            web_empresa   = $('#web_empresa').val(),
            logo_empresa  = $('#logo_empresa').prop('files')
            if(nombre == ''  || direccion == '' || telefono == '' || email_empresa == '' || web_empresa == '' ||  ruc_empresa == '')
            {
                toast_msg('Llena todos los datos', 'Peligro!', 'warning');
                return; 
            }
            if(ruc_empresa.length != '11' )
            {
                toast_msg('RUC incorrecto', 'Peligro!', 'warning');
                $('#documento').focus();
                return;
            }

            let form = new FormData($('#from_empresa')[0]);
            $.ajax({
                url: "{{ route('save_empresa') }}",
                method: "POST",
                data: form,
                cache: false,
                processData: false,
                contentType: false,
                success: function(r){
                    if(!r.status)
                    {
                        toast_msg('No se a adjuntado ningun logo', 'Error', 'error');
                        return;
                    }
                    toast_msg('Datos actualizados', 'Bien', 'success');
                   

                },
                dataType: 'json',
            });
            
    });

</script>