<script>
     function load_datatable()
    {
        let tipo = $('#tipo_servicio').val();
        if(tipo == 1)
        {
            let datatable = $('#reporte_diario').DataTable({
            serverSide  :true,
            "footer": true,
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
            "ajax"          :{
                    'url'     :  "{{ route('reportes.diario') }}",
                    'data'    : { 'tipo_servicio' : $('#tipo_servicio').val(),
                                  'fecha_final' : $('#fecha_final').val(),
                                  '_token': "{{ csrf_token() }}",
                                },
                    'type'    : 'post',
                            },
            "columns"   : [
                {
                   
                    data        : 'idreservacion',
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    },
                    className   : 'text-center'
                     
                },
                {
                    data : 'numero',  className   : 'text-center'
                },
                {
                    data : 'entrada',  className   : 'text-center'
                },
                {
                    data : 'salida',  className   : 'text-center'
                },
                
                {
                    data : 'monto_real',  className   : 'text-center'
                },
                {
                    data : 'dinero_adelantado',  className   : 'text-center'
                },
                {
                    data : 'pendiente_pago',  className   : 'text-center'
                },
                {
                    data : 'mora',  className   : 'text-center'
                },
                {
                    data : 'subtotal',  className   : 'text-center'
                },

            
            ]
        });
        }

        
    }
    load_datatable();

    

</script>