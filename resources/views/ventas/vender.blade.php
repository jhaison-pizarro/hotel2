@extends('layouts.header')
@section('title_content_ol', 'Agregar nueva venta')
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
<div class="row">
  <div class="col-lg-12">
    <div class="table-responsive" style=" overflow-x: hidden;">
          <table class="table table-sm table-bordered" id="tabla_clientes" style="width: 100%; max-width: 100%; font-size: 12px; padding: 5px;">
            <fieldset>
                <legend style="font-size:12px;">Detalles de habitacion</legend>
                <thead style="padding: 5px;">
                </thead>
                <tbody class="" style=".table td { line-height: 0.5; /* Reducir el espacio entre las celdas */}">
                    <tr>
                        <td class="text-left" style="width: 20%;  font-weight: bold; ">Nro habitacion</td>
                        <td class="text-left" style="">Nro {{ $resepcion->numero }}</td>
                        <td class="text-left" style="width: 20%;  font-weight: bold; ">Categoria</td>
                        <td class="text-left" style="">{{ $resepcion->denominacion }}</td>

                        <td class="text-left" style="width: 20%;  font-weight: bold; ">Cliente</td>
                        <td class="text-left" style="">{{ $resepcion->nombre }} {{ $resepcion->apellido }}</td>


                    </tr>
                    <tr>
                        <td class="text-left" style="width: 20%;  font-weight: bold; ">Detalles</td>
                        <td class="text-left" style="">{{ $resepcion->descripcion }}</td>
                        <td class="text-left" style="width: 20%;  font-weight: bold; ">Piso</td>
                        <td class="text-left" style="">{{ $resepcion->idnivel }}</td>
                        <td class="text-left" style="width: 20%;  font-weight: bold; ">Telefono</td>
                        <td class="text-left" style="">{{ $resepcion->telefono }}</td>

                    </tr>
                </tbody>
            </fieldset>
        </table>
    </div>
   </div>
</div>

<fieldset style="border: 1px solid #ddd; border-radius:5px; padding:10px; margin-top:20px">
<legend style="border: 1px solid #ddd; border-radius:5px 10px; padding:5px;  font-size:12px;">Detalle de venta</legend>
<form>
  <div class="row">
    <div class="col-md-3">
      <input type="text" class="form-control"  id="productos" name="productos" placeholder="Producto">
      <input type="text" class="d-none"  id="idproducto" name="idproducto">
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control" id="cantidad_producto" name="cantidad_producto" placeholder="Cantidad" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control" id="precio_producto" name="precio_producto" placeholder="Precio" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" id="pagarahora" name="ventass" value="1">
      <label class="form-check-label">Paga ahora</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" id="pagarluego" name="ventass" value="2">
      <label class="form-check-label">Pagar luego</label>
    </div>                
    <div class="col-md-2">
      <a type="button" class="btn btn-customs btn_agregar_producto btn-block" style="color:white; background-color:green">
          <i class="fa fa-arrow-circle-o-down"></i> Agregar
      </a>
    </div>
   
  </div>
</form>

<br>
<div class="table-responsive">
    <table id="usuarios_table" class="table table-smtable table-bordered" style="font-size: 12px;">
        <thead class="text-center" style="background: #2551f81c; color: #575757; ">
            <tr>
              
                <th scope="col" class="text-center">Producto</th>
                <th scope="col" class="text-center">Cantidad</th>
                <th scope="col" class="text-center">Precio | Unitario</th>
                <th scope="col" class="text-center">Estado</th>
                <th scope="col" class="text-center">Subtotal</th>
                <th scope="col" class="text-center">Opcciones</th>
               
            </tr>
        </thead>
        <tbody class="tbody_productos">

        </tbody>
    </table>
</div>
<br><br>
<div class="form-group row  align-items-center align-content-center">
  <label class="col-xl-8"></label> 
     <div class="col-xl-4 ">
        <div class="form-group row">
          <label class="text-center  text-white col-lg-5 col-form-label-sm" style="background-color: #007bff;">Monto Total S/</label>
          <div class="col-lg-6     o_o_pdd_left_0">
            <input type="text" class="text-center form-control form-control-sm" id="total_operacion" name="total_operacion" readonly="">
          </div>
      </div>
    </div>
</div>
<br>
<br>
</fieldset>
<br>
<div class="pull-right o_o_margin_bt">
    <a type="button" class="btn btn-custom btn_vender_producto" data-id="{{$resepcion->idreservacion}}" data-numero="{{$resepcion->numero}}" style="color:white"><i class="fa fa-save"> Guardar</i> </a>
    <a type="button" class="btn btn-customs " style="color:white"><i class="fa fa-save"> Cancelar</i> </a>
</div>


              
                


@endsection
@section('scripts')
    @include('ventas._myjs')
@endsection