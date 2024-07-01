<script>

  //PDF
  document.getElementById('fecha_final').addEventListener('change', function() {
        var fecha_final = document.getElementById('fecha_final').value;
        var pdfLink = document.getElementById('pdf_link');
        pdfLink.href = "{{ route('report_pdf', ['fecha_final' => ':fecha']) }}".replace(':fecha', fecha_final);
    });

 function seleccionar()
 {
   let tipo =  $('#tipo_servicio').val();
   if(tipo == 1)
   {
       $("#alquiler").removeClass('d-none'); 
       $("#servicio").addClass('d-none');  
       $("#buscar").addClass('d-none');   
   }
   else{
    $("#alquiler").addClass('d-none');
    $("#servicio").removeClass('d-none'); 
    $("#buscar").removeClass('d-none');   
   }

   
 }

 $('body').on('click', '.btn_detalle_buscar', function(){

  var fecha = $('#fecha_final').val();
  $.ajax({


    url     : "{{ route('buscar_detalles') }}",
    method  : 'POST',
    data    : { fecha : fecha,   '_token'    : "{{ csrf_token() }}",},
    success : function(r)
    { 
      if(!r.status)
      {
        toast_msg('Esta habitacion se encuentra ocupada', 'Peligro', 'error');
        return; 
      }
      var count = r.detalle.length;
  
      let html = '';
      for(var i = 0; i < count; i++)
      {
       
        html += `<tr>

          <td class="text-center">${i +1}</td>
          <td class="text-left">${r.detalle[i].producto_det}</td>
          <td class="text-center">${r.detalle[i].cant_produc}</td>
          <td class="text-center">${r.detalle[i].precio}</td>
          <td class="text-center">${r.detalle[i].fechaventa}</td>`
          if(r.detalle[i].estado_detalle ==1)
          {
            html += `<td class="text-center">Pagado</td>`;
          }
          else
          {
            html += `<td class="text-center">Falta pagar</td>`;
          }
          html += `<td class="text-center">${r.detalle[i].usuario}</td>
                  <td>S/ ${r.detalle[i].cant_produc * r.detalle[i].precio}.00 </td>`;
         

          
          
          
          
          html+= `</tr>`
      }
      html+=`
           <tr style="text-align:left; color:red; font-weight: bold">
            <td colspan="6"></td>
            <td align="left">Total pagado</td>
            <td align="left" id="">S/ ${r.monto_pagado}.00</td>

          </tr> <tr style="text-align:left; color:red; font-weight: bold">
            <td colspan="6"></td>
            <td align="left">Falta pagar</td>
            <td align="left" id="">S/ ${r.monto_falta}.00</td>
          </tr>
          <tr style="text-align:left; color:red; font-weight: bold">
            <td colspan="6"></td>
            <td align="left">Total</td>
            <td align="left" id="">S/ ${r.h}.00</td>
          </tr>`

      $('.tbody_detalles').html(html);

    },
    dataType : 'json',

  })

  

 })

        var fecha_final = document.getElementById('fecha_final').value;
        var pdfLink = document.getElementById('pdf_link');
        pdfLink.href = "{{ route('report_pdf', ':fecha') }}".replace(':fecha', fecha_final);
  
    

</script>