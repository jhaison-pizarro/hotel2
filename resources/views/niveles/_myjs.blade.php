<script>

$('body').on('click', '.btn_save_nivel', function()
{
    event.preventDefault();

    let denominacion = $('#denominacion_nivel').val();

    if(denominacion == '')
    {
        toast_msg('LLene todos los campos', 'Peligro!', 'warning')
        return;
    }
    $.ajax({

            url     : "{{ route('save_nivel') }}",
            method  : 'POST',
            data    : {
                        '_token'    : "{{ csrf_token() }}",
                        denominacion : denominacion
                      }, 
                      success : function(r)
                      {
                        if(!r.status)
                        {
                            toast_msg('Intente nuevamente', 'Error!', 'error')
                            return;
                        }

                        toast_msg('Registro insertado correctamente', 'Bien!', 'success') 
                        load_datatable();   
                        $('#modal_niveles').modal('hide');                    
                      },
                      dataType : 'json'

            })

});

$('body').on('click', '.btn-edit_nivel', function()
{
    event.preventDefault();
    let idnivel = $(this).data('id');
    $.ajax({

            url     : "{{ route('edit_nivel') }}",
            method  : 'POST',
            data    : {'_token'    : "{{ csrf_token() }}",
                        idnivel : idnivel  
                      },
         success: function(r)
         {
            if(!r.status)
            {
                toast_msg('Intente nuevamente', 'Error!', 'error')
                return;  
            }
            $('#edit_denominacion_nivel').val(r.niveles.denominacion);
            $('#edit_idnivel').val(r.niveles.idnivel),
            $('#edit_modal_niveles').modal('show');
         },
         dataType : 'json'


    })
    

});

$('body').on('click', '.btn_update_nivel', function(){
    event.preventDefault();
    let idnivel     =   $('#edit_idnivel').val();
        denominacion=   $('#edit_denominacion_nivel').val();
        $.ajax({
            url    : "{{ route('update_nivel') }}",
            method : 'POST',
            data   : {'_token'    : "{{ csrf_token() }}",
                        idnivel : idnivel,
                        denominacion : denominacion
                      },
            success : function(r)
            {
               if(!r.status)
               {
                
                toast_msg('Intente nuevamente', 'Error!', 'error')
                return;  
               }
               toast_msg('Registro actualizado correctamente', 'Bien!', 'success') 
               load_datatable();  
               $('#edit_modal_niveles').modal('hide');      
            },
            dataType : 'json'
        }) 
    
});

$('body').on('click', '.btn-delete_nivel', function()
{
    event.preventDefault();
    let idnivel  = $(this).data('id');
     $('.btn_delete_nivel').val(idnivel);
     $('#modal_delete_nivel').modal('show');
   
});

$('body').on('click', '.btn_delete_nivel', function()
{
    event.preventDefault();
    let idnivel = $(this).val();
    $.ajax({
         
            url    : "{{ route('delete_nivel') }}",
            method : 'POST',
            data   : {
                '_token'    : "{{ csrf_token() }}",
                idnivel : idnivel,
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
                $('#modal_delete_nivel').modal('hide');


            },
            dataType : 'json',

    })
})
</script>