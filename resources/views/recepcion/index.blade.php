
@extends('layouts.header')
@section('title_content_ol', 'Reservacion habitaciones')
@section('content')
<style>
  .centrado {
    display: block;
    text-align: center;
 
  }
</style>
<div class="row">
    <div class="col-lg-6">
      <div class="form-group row">
        <label for="uname" class="col-sm-3 control-label"></label>
        <div class="col-sm-9">
          <div class="input-group">
            <select class="form-control" id="niveles_piso" placeholder="Username" type="text">
              <option value="">[Seleccione]</option>
              @foreach($niveles as $nivels)
                <option value="{{$nivels->idnivel}}">{{$nivels->denominacion}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 reloj">
        <p class="fecha"></p>
        <p class="tiempo"></p>
    </div>
</div>
<div id="mostrar_habitaciones" class="content">
  <div class="row">
    @foreach($habitaciones as $habitacion) 
      <div class="col-lg-3 col-xs-3 m-b-3">
       <div class="card">
       
            @if($habitacion->estado == '0')
            <div class="card-body"><span class="info-box-icon bg-success">
            @endif
            @if($habitacion->estado == '1')
            <div class="card-body"><span class="info-box-icon bg-red">
            @endif
            @if($habitacion->estado == '2')
            <div class="card-body"><span class="info-box-icon bg-primary">
            @endif
            @if($habitacion->estado == '0')
            <i class="fa fa-unlock-alt" style="color:white"></i>
            @endif
            @if($habitacion->estado == '1')
            <i class="fa fa-bed"></i>
            @endif
            @if($habitacion->estado == '2')
            <i style="color:white" class="fa fa-leaf"></i>
            @endif
          </span>
            <div class="info-box-content"> <span class="info-box-number">Nro: {{ $habitacion->numero }}</span> <span class="info-box-text">CATEGORIA: {{ $habitacion->nombre }}</span> </div>
           @if($habitacion->estado == '0')
            <br>
           <a class="centrado" href="{{ route('reservar_disponible', $habitacion->idhabitacion) }}" style=" text-align: center; color:white; padding:3px; background-color: #28a745;">DISPONIBLE <i class="fa fa-long-arrow-right"></i></a>
           @endif
           @if($habitacion->estado == '1')
          <br>
           <a type="button" class="centrado btn_ocupado"  style="color:white; padding:3px; background-color: #dd4b39">OCUPADO <i class="fa fa-long-arrow-right"></i></a>
           @endif
           @if($habitacion->estado == '2')
          <br>
           <a type="button" class="centrado btn_limpieza"  data-id="{{$habitacion->idhabitacion}}" style="color:white; padding:3px; background-color: #39b1dd">EN LIMPIEZA <i class="fa fa-long-arrow-right"></i></a>
           @endif

          </div>
        </div>
      </div>
    
    @endforeach
  </div>
</div>

@endsection
@section('scripts')
@include('recepcion._myjs')
 
@endsection