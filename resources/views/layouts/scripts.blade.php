<script>
   function verifi_stock()
   {
      $.ajax({

        url    : "{{ route('notifi_stock') }}",
        method : 'POST',
        data   : {  
            '_token'    : "{{ csrf_token() }}",
        },  
      success: function(r)
      { 
        if(!r.status)
        {
            document.getElementById("notificaciones").innerHTML = `<h5>Aun cuenta con stock</h5>`;
                         
        }
        let html = '';
       
        for(var i= 0; i < r.data.length; i++)
        {
            html+=`<p>${i+1}.-${r.data[i].nombre}</p>`
        }
        document.getElementById("notificaciones").innerHTML = html;


      },
      dataType : 'json'


      })
   }
   verifi_stock();

   </script>