<style>
    #reporte_diario {
        font-size: 13px;
        width: 100%;
        border-collapse: collapse;
    }
    
    #reporte_diario th,
    #reporte_diario td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: center;
    }
    
    #reporte_diario th {
        background-color: #2551f81c;
        color: #575757;
    }
    
    #reporte_diario tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    
    #reporte_diario tbody tr:hover {
        background-color: #ddd;
    }
</style>
<h1 style="font-size:12px">Reportes de productos vendidos - fecha {{ $fecha }}</h1>
<table id="reporte_diario" class="table table-sm table-bordered">
    <thead class="text-center">
        <tr>
            <th scope="col" width="8%">N°</th>
            <th scope="col">Producto</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio Unit</th>
            <th scope="col">Fecha</th>
            <th scope="col">Estado</th>
            <th scope="col">Responsable</th>
            <th scope="col" width="10%">Subtotal</th>
        </tr>
    </thead>
    <tbody class="tbody_detalles">
        @foreach ($detalle as $index => $detalles)
        <tr>    
            <td class="text-center">{{ $index +1 }}</td>
            <td class="text-center">{{ $detalles->producto_det}}</td>
            <td class="text-center">{{ $detalles->cant_produc}}</td>
            <td class="text-center">{{ $detalles->precio}}</td>
            <td class="text-center">{{ $detalles->fechaventa}}</td>
            @if($detalles->estado_detalle ==1)
            <td class="text-center">Pagado</td>
            @endif
            @if($detalles->estado_detalle ==2)
            <td class="text-center" style="color:red">Pendiente</td>
            @endif
            <td class="text-center">{{$detalles->usuario}}</td>
            <td class="text-center">S/ {{$detalles->cant_produc * $detalles->precio}}.00</td>
        </tr>
        </tr>
        @endforeach
        <tfoot>
            <tr style="text-align:left; color:red; font-weight: bold">
                <td colspan="6"></td>
                <td align="left">Total pagado</td>
                <td align="left" id="">S/{{ $monto_pagado }}</td>
    
              </tr> <tr style="text-align:left; color:red; font-weight: bold">
                <td colspan="6"></td>
                <td align="left">Falta pagar</td>
                <td align="left" id="">S/{{ $monto_falta }}</td>
              </tr>
              <tr style="text-align:left; color:red; font-weight: bold">
                <td colspan="6"></td>
                <td align="left">Total</td>
                <td align="left" id="">S/ {{ $monto_subtotal }}</td>
              </tr>`
        
        </tfoot>
        

      
    </tbody>
</table>