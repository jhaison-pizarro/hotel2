<script>
   $("#niveles_piso").change(function(){
      var idnivel = $("#niveles_piso").val();
      $.ajax({

        url     : "{{ route('habitaciones_niveles') }}",
        method : "POST",
        data   : {
            
            '_token'    : "{{ csrf_token() }}",
            idnivel:idnivel},
        success : function(r){

            if(!r.status)
            {
                toast_msg('Intente nuevamente', 'Error!', 'error')
                return;
            }
            let habitaciones = r.habitaciones_nivel,    
                html = '<div class="row">';
                estado = '';
                
            for(var i = 0; i < habitaciones.length; i++)
            {
                html +=`<div class="col-lg-3 col-xs-3 m-b-3">
                            <div class="card">`
                        if(habitaciones[i].estado==0)
                        {
                            html +=`<div class="card-body"><span class="info-box-icon bg-success">`
                        }
                        if(habitaciones[i].estado==1)
                        {
                            html +=`<div class="card-body"><span class="info-box-icon bg-red">`
                        }
                        if(habitaciones[i].estado==2)
                        {
                            html +=`<div class="card-body"><span class="info-box-icon bg-primary">`
                        }
                        if(habitaciones[i].estado==0)
                        {
                            html +=`<i class="fa fa-unlock-alt" style="color:white"></i>`
                        }
                        if(habitaciones[i].estado==1)
                        {
                            html +=`<i style="color:white" class="fa fa-bed"></i>`
                        }
                        if(habitaciones[i].estado==2)
                        {
                            html +=`<i style="color:white" class="fa fa-leaf"></i>`
                        }
                        html +=`</span><div class="info-box-content"> <span class="info-box-number">Nro: ${habitaciones[i].numero }</span> <span class="info-box-text">CATEGORIA: ${habitaciones[i].nombre }</span> </div>`
                        if(habitaciones[i].estado==0)
                        {
                            html +=`<br>
                            <a class="centrado" target="_blank" href=" {{ route('reservar_disponible', '') }}/${habitaciones[i].idhabitacion}" style=" text-align: center; color:white; padding:3px; background-color: #28a745;">DISPONIBLE <i class="fa fa-long-arrow-right"></i></a>`
                        }
                        if(habitaciones[i].estado==1)
                        {
                            html +=`<br>
                            <a class="centrado btn_ocupado" style="color:white; padding:3px; background-color: #dd4b39">OCUPADO <i class="fa fa-long-arrow-right"></i></a>`;
                        }
                        if(habitaciones[i].estado==2)
                        {
                            html +=`  <br>
                            <a type="button" class="centrado btn_limpieza"  data-id="${habitaciones[i].idhabitacion}" style="color:white; padding:3px; background-color: #39b1dd">EN LIMPIEZA <i class="fa fa-long-arrow-right"></i></a>`
                        }

                        html+=` </div>
                                </div>
                            </div>`
                }
                   
                    
                
            
           
        $('#mostrar_habitaciones').html(html);
        verifi_stock();
        },
        dataType : "json"

      })
    });

    $('body').on('click', '.btn_ocupado', function(){

        toast_msg('Habitacion ocupada', 'Peligro', 'warning');
        return; 
    })
    

    $('body').on('click', '.btn_limpieza', function(){
        var idhabitacion = $(this).data('id');
     

        Swal.fire({
            title: "Ya esta limpio la habitacion?",
            showDenyButton: true,
            confirmButtonText: "Si",
            denyButtonText: `No`
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
               
                 $.ajax({

                    url    : "{{ route('limpieza')  }}",
                    method : "POST",
                    data   : {

                        '_token'    : "{{ csrf_token() }}",
                        idhabitacion:idhabitacion},
                    success : function(r)
                    {
                        if(!r.status)
                        {
                            toast_msg('Intente nuevamente', 'Error!', 'error')
                            return;
                        }
                       
                       
                    },
                    dataType : "json",
                 })
                 Swal.fire("Habitacion limpia", "", "success");
                  setTimeout(function() {
                            window.location.href = "{{ url('recepcion') }}"; 
                        }, 1000);  
                  
                
            }else if (result.isDenied) {
                Swal.fire("Cancelado", "", "info");
            }


        });
    });


const $tiempo=document.querySelector('.tiempo'),
$fecha= document.querySelector('.fecha');
function Relojdigital(){
    let f=new Date(),
    dia= f.getDate(),
    mes= f.getMonth()+1,
    anio= f.getFullYear(),
    diaSemana=f.getDay();

    dia= ('0'+dia).slice(-2);
    mes=('0'+mes).slice(-2)

    let timeString= f.toLocaleTimeString();
    $tiempo.innerHTML=timeString;

    let semana=['DOMINGO','LUNES','MARTES','MIERCOLES','JUEVES','VIERNES','SABADO'];
    let showSemana= (semana[diaSemana])
    $fecha.innerHTML = `${showSemana} ${dia}/${mes}/${anio}`
}
setInterval(() =>{
    Relojdigital()
},1000);

</script>