
@extends('layouts.header')
@section('title_content_ol', 'Reportes')
@section('content')

<div class="row">
    <div class="col-lg-4">
      <fieldset class="form-group">
        <label>Tipo</label>
        <small class="text-muted"><i class="text-danger">(*Seleccione tipo de servicio)</i></small>
        <select class="form-control" id="tipo_servicio" name="tipo_servicio" type="text" onchange="seleccionar()">
            <option value="1">Alquiler</option>
            <option value="2">Servicio</option>
        </select>
      </fieldset>
    </div>
    <div class="col-lg-4">
      <fieldset class="form-group">
        <label>Fecha </label>
        <small class="text-muted"><i class="text-danger">(Selecciones la fecha)</i></small>
        <input class="form-control" id="fecha_final" name="fecha_final" value="{{ date('Y-m-d') }}"type="date">
      </fieldset>
    </div>
    <div id="buscar" class="col-lg-4 d-none" style="margin-top:28px">
      <button type="button" class="btn btn-primary btn_detalle_buscar">Buscar</button>
      <a id="pdf_link"  target="_blank"href="{{ route('report_pdf', ['fecha_final' => ':fecha']) }}" class="btn btn-primary text-white">PDF</a>
    </div>
</div>
<div class="table-responsive" id="alquiler">
    <table id="reporte_diario" class="table table-smtable table-bordered" style="font-size: 13px; ">
        <thead class="text-center" style="background: #2551f81c; color: #575757; ">
            <tr>
                <th scope="col" width="8%" class="text-center">N°</th>
                <th scope="col" class="text-center">N° Habitacion</th>
                <th scope="col" class="text-center">F. Ingreso</th>
                <th scope="col" class="text-center">F. Salida</th>
                <th scope="col" class="text-center">Monto real</th>
                <th scope="col" class="text-center">Dinero adelantado</th>
                <th scope="col" class="text-center">Pendiente de pago</th>
                <th scope="col" class="text-center">Penalidad</th>
                <th scope="col" width="10%" class="text-center">Subtotal</th>
            </tr>
        </thead>
       
    </table>
</div>
<div class="table-responsive d-none" id="servicio">
  <table id="reporte_diario" class="table table-smtable table-bordered" style="font-size: 13px; ">
      <thead class="text-center" style="background: #2551f81c; color: #575757; ">
          <tr>
              <th scope="col" width="8%" class="text-center">N°</th>
              <th scope="col" class="text-center">Producto</th>
              <th scope="col" class="text-center">Cantidad</th>
              <th scope="col" class="text-center">Precio Unit</th>
              <th scope="col" class="text-center">Fecha</th>
              <th scope="col" class="text-center">Estado</th>
              <th scope="col" class="text-center">Responsable</th>
              <th scope="col" width="10%" class="text-center">Subtotal</th>
          </tr>
      </thead>
      <tbody class="tbody_detalles">

      </tbody>
      
  </table>
</div>


@endsection

@section('scripts')
 @include('reportes.jsdatatable')
 @include('reportes._myjs')
@endsection