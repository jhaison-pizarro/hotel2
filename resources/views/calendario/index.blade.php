@extends('layouts.header')
@section('title_content_ol', 'Calendario de eventos')
@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card">
      <div class="card-body">
        <div class="row">
          <div class="col-lg-3">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h4 class="box-title">Lista de reservas</h4>
              </div>
              <div class="box-body"> 
                <!-- the events -->
                <div id="external-events">
                  @foreach($eventos as $event)
                    <div class="external-event text-white eventos" style="background-color:{{ $event->color }}; text-transform: capitalize;" data-id="{{ $event->id }}">{{ $event->descripcion }} </div>
                  @endforeach
                  <div class="checkbox">
                    <label for="drop-remove">
                      <input type="checkbox" id="drop-remove">
                       Eliminar reserva</label>
                  </div>
                </div>

              </div>
              
            </div>
            <!-- /. box -->
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Crear Evento </h3>
              </div>
              <div class="box-body">
                
                <!-- /btn-group -->
                <div class="input-group">
                  <input id="new-event" type="text" class="form-control" placeholder="Titulo">
                </div>
                <div class="input-group">
                  <input id="fecha_i" type="date" class="form-control" placeholder="Titulo">
                  <input id="fecha_f" type="date" class="form-control" placeholder="Titulo">
                </div>
                <br>
                <div class="btn-group" style="width: 100%; margin-bottom: 10px;"> 
                  <ul class="fc-color-picker" id="color-chooser">
                    <li><a class="text-aqua" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-blue" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-light-blue" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-teal" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-yellow" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-orange" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-green" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-lime" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-red" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-purple" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-fuchsia" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-muted" href="#"><i class="fa fa-square"></i></a></li>
                    <li><a class="text-navy" href="#"><i class="fa fa-square"></i></a></li>
                  </ul>
                  
                </div>
                <div class="d-flex">
                  <button id="add-new-event" type="button" class="btn btn-rounded btn-primary" style="margin: auto;
              ">Añadir Reserva</button>
                </div>
                
                 
                
                <!-- /input-group --> 
              </div>
            </div>
          </div>
          <div class="col-lg-9 m-t-2">
            <div class="col-bor box box-primary">
              <div class="box-body no-padding"> 
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
              </div>
              <!-- /.box-body --> 
            </div>
            <!-- /. box --> 
          </div>
        </div>
      </div>
      </div>
    </div>
  </div>
  




@endsection
@section('scripts')
 @include('calendario._myjs')
@endsection