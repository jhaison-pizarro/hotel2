<script>
    // habitacion// 
    var total_habitacion       = parseFloat($('#total_detalles').val()) || 0;
    //moto total
    var total_pagar = parseFloat($('#total_pagar').val()) || 0;
    $('.btn_culminar').val(total_pagar);
    
    function calcularTotal() 
    {
        var mora = parseFloat($('#mora_penalidad').val()) || 0;
        
        if(mora!= 0)
        {
            var total =  mora +  total_pagar;
            $('#total_pagar').val(total);
            $('.btn_culminar').val(total);
            return;
        }
        $('#total_pagar').val(total_pagar);
      
    }
function guardar_penalidad(idreservacion,mora, monto_total)
{
    $.ajax({

        url    : "{{ route('mora')}}",
        method : 'post',
        data   : {idreservacion:idreservacion,mora:mora,monto_total:monto_total, '_token': "{{ csrf_token() }}" },
        success: function(r)
        {

        },
        dataType : 'json'
    })
}


$('body').on('click', '.btn_culminar', function(){
     var idreservacion   = $(this).data('id');
     var mora            = parseFloat(document.querySelector(".mora_penalidad").value)
         monto_total     = $(this).val();
       
        guardar_penalidad(idreservacion, mora, monto_total);
        $('#A4').data('variable', idreservacion);
        $('#modal_tick').modal('show');
})

$('body').on('click', '.A4', function(){


      
    

})

</script>