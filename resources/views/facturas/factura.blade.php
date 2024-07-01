<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Factura</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    .company-details {
        border: 1px solid #ccc;
        padding: 10px;
        margin-top: 10px;
        border-radius: 8px;
        overflow: hidden; /* Para mantener la misma línea vertical */
    }
    .company-details h3 {
        margin: 0;
        padding: 5px;
        background-color: #7db4b5; /* Color diferente para el título */
        border-top-left-radius: 8px; /* Border radius en la esquina superior izquierda */
        border-top-right-radius: 8px; /* Border radius en la esquina superior derecha */
    }
    .company-details pre {
        margin: 0;
        padding-left: 5px; /* Ajuste de padding para mantener la alineación vertical */
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td valign="top"><img src="{{ asset('logo_empresa/' . $empresa->logo) }}" alt="" width="150"/></td>
        <td align="right">
            <div class="company-details">
                <h3>{{$empresa->nombre}}</h3>
                <pre>
                   Direccion: {{$empresa->direccion}}
                   RUC      : {{$empresa->ruc}}
                   Telefono : {{$empresa->telefono}}
                   Fecha    : {{date('Y-m-d')}}
                </pre>
            </div>
        </td>
    </tr>

  </table>
  <br>
  <br>

  <table width="100%">
    <tr>
        <td><strong>Cliente:</strong> {{$resepcion->nombre}} {{$resepcion->apellido}} </td>
        <td><strong>DNI:</strong> {{$resepcion->dni}}</td>
    </tr>

  </table>

<h5> Detalles habitacion</h5>
  <table width="100%">
    <thead style="background-color: #7db4b5;">
      <tr>
        <th>N°</th>
        <th>habitacion</th>
        <th>Tipo</th>
        <th>F. Entrada</th>
        <th>F. Salida</th>
        <th>P | Unitario</th>
        <th>´Total por dias</th>
    </thead>
    <tbody>
            <tr style="text-align:center"> 
                <td>1</td>
                <td>{{$resepcion->numero}}</td>
                <td>{{$resepcion->denominacion}}</td>
                <td>{{$resepcion->entrada}}</td>
                <td>{{$resepcion->salida}}</td>
                <td>S/{{$resepcion->precio}}.00</td>
                <td>S/{{$resepcion->monto}}.00</td>
            </tr>
    </tbody>
    <br>
    <tfoot>
        <tr style="text-align:left">
            <td colspan="5"></td>
            <td align="left">Subtotal</td>
            <td align="left" id="monto_consumo">S/ {{$resepcion->monto}}.00</td>
        </tr>
        <tr style="text-align:left">
            <td colspan="5"></td>
            <td align="left">Adelanto</td>
            <td align="left">S/ {{$resepcion->adelanto}}.00</td>
        </tr>
        <tr style="text-align:left">
            <td colspan="5"></td>
            <td align="left">Penalidad</td>
            @if($resepcion->mora == null)
            <td align="left">S/ 00</td>
            @endif
            @if($resepcion->mora!= null)
            <td align="left">S/ {{$resepcion->mora}}.00</td>
            @endif
            
        </tr>
        <tr style="text-align:left">
            <td colspan="5"></td>
            <td align="left">Falta pagar</td>
            <td align="left">S/ {{$montopagar}}.00</td>
           
            
        </tr>
        
    </tfoot>
    <br>
    
  </table>
  <h5> Detalles consumo</h5>
  <table width="100%">
    <thead style="background-color: #7db4b5;">
      <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>P | Unitario</th>
        <th>Total</th>
    </thead>
    <tbody> 
    @foreach($detalle_reservacion as $detalle_reservaciones)
                <tr style="text-align:left">
                    <td class="text-left">{{$detalle_reservaciones->nombre}}</td>
                    <td class="text-center">{{$detalle_reservaciones->cantidad}}</td>
                    <td class="text-center">{{$detalle_reservaciones->precio}}</td>
                    <td class="text-center">S/ {{$detalle_reservaciones->cantidad * $detalle_reservaciones->precio}}.00</td>
                    
                </tr>         
    @endforeach
    <br>
    <tfoot>
        <tr style="color:red">
            <td colspan="2"></td>
            <td align="center">Total consumo</td>
            <td align="left" id="monto_consumo">S/{{$monto_detalles}}.00</td>
        </tr>
        
    </tfoot>
    <br>
    <tfoot>
    <tr>
            <td colspan="2"></td>
            <td align="right">Subtotal $</td>
            <td align="right">S/ {{$monto_detalles}}.00</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td align="right">Dinero pagado</td>
            <td align="right">S/ {{$monto_total_pagado}}.00</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td align="right">Falta pagar</td>
            <td align="right">S/ {{$monto_total_falta}}.00</td>
        </tr>
       
        
    </tfoot>
  
    </tbody>
    
    
  </table>

</body>
</html>
