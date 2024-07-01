@extends('layouts.header')
@section('title_content_ol', 'Verification de salidas')
@section('content')
<style>
 .btn-custom {
  background-color: #007bff; /* Cambia el color de fondo */
  color: white; /* Cambia el color del texto */
  border: none; /* Elimina el borde */
  border-radius: 5px; /* Agrega bordes redondeados */
  padding: 5px 10px; /* Ajusta el espaciado interno */
}
.btn-customs {
  background-color: red; /* Cambia el color de fondo */
  color: white; /* Cambia el color del texto */
  border: none; /* Elimina el borde */
  border-radius: 5px; /* Agrega bordes redondeados */
  padding: 5px 10px; /* Ajusta el espaciado interno */
}

</style>

<div class="table-responsive" style=" overflow-x: hidden;">
                <table class="table table-smtable table-bordered" id="tabla_clientes" style=" width:100%; /* Reduciendo el ancho al 50% del contenedor */
                max-width: 100%; /* O estableciendo un ancho máximo */
                font-size: 12px; padding: 5px/* Reduciendo el tamaño de fuente para ajustar */">
                    <thead style="padding: 5px;">
                       
                    </thead>
                    <tbody class="" style=".table td {
                        line-height: 1; /* Reducir el espacio entre las celdas */
                    }">
                         <tr>
                            <td class="text-left" style="width: 20%;">Nro de habitación</td>
                            <td class="text-left" style="">N° {{$resepcion->numero}}</td>
                            <td class="text-left" style="width: 20%;">Tipo</td>
                            <td class="text-left" style="">{{$resepcion->denominacion}}</td>
                            <td class="text-left" style=" width: 20%;">Entrada</td>
                            <td class="text-left" style="">{{$resepcion->entrada}}</td>

                        </tr>
                        <tr>
                            <td class="text-left" style=" width: 20%;">Precio por dia</td>
                            <td class="text-left" style="">S/ {{$resepcion->precio}}.00</td>
                            <td class="text-left" style="width: 20%;">Cliente</td>
                            <td class="text-left">{{$resepcion->nombre}} {{$resepcion->apellido}}| {{$resepcion->dni}}</td>
                            <td class="text-left" style=""> Salida</td>
                            <td class="text-left" style="">{{$resepcion->salida}}</td>
                        </tr>
                       
                    
                    </tbody>
                </table>
</div>
<div class="table-responsive">
    <h5 style="padding:5px 8px 5px; color : white; background-color: #1183e1;">Detalle de alojamiento</h5>
    <table id="usuarios_table" class="table table-smtable table-bordered" style="font-size: 12px;">
        <thead class="text-center" style="background: #2551f81c; color: #575757; ">
            <tr>
              
                <th scope="col" class="text-center">Costo de alojamiento</th>
                <th scope="col" class="text-center">Dinero adelantado</th>
                <th scope="col" class="text-center">Mora|Penalidad</th>
                <th scope="col" class="text-center">S/ Por pagar</th>
              
               
            </tr>
        </thead>
        <tbody class="tbody_detalle habitacion">
               <tr>
                    <td class="text-center" id="monto">{{$resepcion->monto}}.00</td>
                    @if($resepcion->adelanto == null)
                    <td class="text-center" id="adelanto">00.00</td>
                    @endif
                    @if($resepcion->adelanto != null)
                    <td class="text-center" id="adelanto">{{$resepcion->adelanto}}</td>
                    @endif
                    <td width="10%" class="text-center" ><input class="form-control form-control-sm mora_penalidad" id="mora_penalidad" oninput="calcularTotal()"></td>

                    @if($resepcion->adelanto != null )
                    <td width="10%" class="text-center"><input class="form-control form-control-sm" id="total_detalles" name="total_detalles"value="{{$total_habitacion}}" readonly ></td>
                    @endif
                    @if($resepcion->adelanto == null )
                    <td width="10%" class="text-center"><input class="form-control form-control-sm" id="total_detalles" name="total_detalles"value="0" readonly ></td>
                    @endif
               </tr>
                
        </tbody>
    </table>
</div>
<div class="table-responsive">
    <h5 style="padding:5px 8px 5px; color : white; background-color: #1183e1;">Detalle de consumo</h5>
    <table id="usuarios_table" class="table table-smtable table-bordered" style="font-size: 12px;">
        <thead class="text-center" style="background: #2551f81c; color: #575757; ">
            <tr>
              
                <th scope="col" class="text-center">Producto</th>
                <th scope="col" class="text-center">Cantidad</th>
                <th scope="col" class="text-center">Precio unitario</th>
                <th scope="col" class="text-center">Estado</th>
                <th scope="col" class="text-center">Subtotal</th>
              
               
            </tr>
        </thead>
        <tbody class="tbody_detalle habitacion">
                @foreach($detalle_reservacion as $detalle_reservaciones)
                <tr>

                    <td class="text-left">{{$detalle_reservaciones->nombre}}</td>
                    <td class="text-center">{{$detalle_reservaciones->cantidad}}</td>
                    <td>{{$detalle_reservaciones->precio}}</td>
                    @if($detalle_reservaciones->estado_detalle == 1)
                    <td class="badge badge-success">PAGADO</td>
                    @endif
                    @if($detalle_reservaciones->estado_detalle == 2)
                    <td class="badge badge-danger">FALTA PAGAR</td>
                    @endif
                    <td class="text-center">S/ {{$detalle_reservaciones->cantidad * $detalle_reservaciones->precio}}.00</td>
                    
                </tr>
                

                @endforeach
                <tfoot>
       
        
                </tfoot>
              
                
        </tbody>
    </table>
</div>
<div class="form-group row align-items-right align-content-right">
    <label class="col-xl-8"></label>
    <div class="col-xl-4">
        <div class="form-group row justify-content-end">
            <label class="text-center  text-white col-lg-5 col-form-label-sm" style="background-color: #007bff;">Monto a pagar S/ </label>
            <div class="col-lg-6 o_o_pdd_left_0">
                <input type="text" class="text-center form-control form-control-sm" id="total_pagar" name="total_pagar" value="{{$montoPagar}}.00" readonly="">
            </div>
        </div>
    </div>
</div>

<div class="pull-right o_o_margin_bt">
    <a type="button" class="btn btn-custom btn_culminar" data-id="{{$resepcion->idreservacion}}" data-numero="{{$resepcion->numero}}" style="color:white"><i class="fa fa-save"> Culminar y limpiar habitacion</i> </a>
    <a href="javascript:history.back()" class="btn btn-customs " style="color:white"><i class="fa fa-save"> Cancelar</i> </a>
</div>


<!-- MODAL -->
<div class="modal fade" id="modal_tick" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 style="text-align:center; margin:auto">¿Estas seguro de finalizar la habitacion?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
      <div class="row justify-content-center">
    <div class="col-lg-5 col-xs-6 m-b-3">
        <a href=" {{ route('factura', $resepcion->idreservacion) }}" target="_blank" id="A4" class="card-link A4">
            <div class="card">
                <div class="card-body"><span class="info-box-icon bg-aqua"><i class="fa fa-file-pdf-o"></i></span>
                    <div class="info-box-content"> <span class="info-box-number text-primary">A4</span> <span class="info-box-text text-primary">Factura A4</span> </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-5 col-xs-6 m-b-3">
        <a href="#" class="card-link">
            <div class="card">
                <div class="card-body"><span class="info-box-icon bg-green"><i class="fa fa-file-pdf-o"></i></span>
                    <div class="info-box-content"> <span class="info-box-number text-primary">A2</span> <span class="info-box-text text-primary">Ticket A2</span></div>
                </div>
            </div>
        </a>
    </div>
</div>



                
       </div>
     </div>
  </div>
</div>             
                


@endsection
@section('scripts')
    @include('salidas._myjs')
@endsection