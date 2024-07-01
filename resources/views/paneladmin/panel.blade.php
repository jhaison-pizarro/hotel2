@extends('layouts.header')
@section('title_content_ol', 'Panel de control')
@section('content')
<div class="row">
  <div class="col-lg-3 col-xs-6 m-b-3">
    <div class="card">
      <div class="card-body"><span class="info-box-icon bg-olive"><i class="fa fa-home"></i></span>
        <div class="info-box-content"> <span class="info-box-number">{{ $total }}</span> <span class="info-box-text">TOTAL HABITACIONES</span> </div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6 m-b-3">
    <div class="card">
      <div class="card-body"><span class="info-box-icon bg-success"><i style="color:white" class="fa fa-unlock-alt"></i></span>
        <div class="info-box-content"> <span class="info-box-number">{{ $libres }}</span> <span class="info-box-text">HABITACIONES LIBRES</span></div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6 m-b-3">
    <div class="card">
      <div class="card-body"><span class="info-box-icon bg-red"><i class="fa fa-bed"></i></span>
        <div class="info-box-content"> <span class="info-box-number">{{ $ocupadas }}</span> <span class="info-box-text">HABITACIONES OCUPADAS</span></div>
      </div>
    </div>
  </div>
  <div class="col-lg-3 col-xs-6 m-b-3">
    <div class="card">
      <div class="card-body"><span class="info-box-icon bg-primary"><i style="color:white" class="fa fa-leaf"></i></span>
        <div class="info-box-content"> <span class="info-box-number">{{ $limpieza }}</span> <span class="info-box-text">HABITACIONES EN LIMPIEZA</span></div>
      </div>
    </div>
  </div>
  
  
</div>

<div class="row">
  <div class="col-lg-5 m-b-3">
    <div class="card">
      
    </div>
  </div>
  <div class="col-lg-7">
    <div class="card">
      <div class="card-body">
        <h5>Datos de caja<span class="pull-right f-13"><a href="{{ route('apertura.index') }}">ir a cajas</a></span></h5>
        <div class="box-body"> 
          <div class="col-lg-12">
            
            </div>
            @if($caja->estados == 2)
            <h1 class="text-danger">Debe aperturar su caja</h1>
            @endif
            @if($caja->estados ==  1)
            <div class="card m-b-3">
             <div class="card-body">
                <div class="box-body"> <strong><i class="fa fa-user margin-r-5"></i>Usuario</strong>
                  <p class="text-muted"> {{ session('nombre') }} </p>
                  <hr>
                  <strong><i class="fa fa-calendar-o margin-r-5"></i>Fecha y hora apertura</strong>
                  <p class="text-muted">{{ $caja->fecha }} - {{ $caja->hora }}</p>
                  <hr>
                  <strong><i class="fa fa-bank margin-r-5"></i>Monto inicial</strong>
                  <p>S/ {{ $caja->monto }}<p>
                  <hr>
                  <strong><i class="fa fa-bank margin-r-5"></i>Monto actual [+]</strong>
                  <h1>S/ {{ $caja->actual  }}</h1>
                
              </div>
            
          </div>
          @endif
        </div>
        <div class="box-footer">
          
        </div>
      </div>
    </div>
  </div>
</div>
    
    
@endsection
@section('scripts')

@endsection