@extends('layouts.header')
@section('title_content_ol', 'Aperturar caja')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="fecha_apertura">Fecha de apertura</label>
                            <input type="date" class="form-control" id="fecha_apertura" name="fecha_apertura" value="{{date('Y-m-d')}}">
                        </div>
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input class="form-control" id="idusuario" name="idusuario" value="{{ session('usuario') }}" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="hora_apertura">Hora de apertura</label>
                            <input type="time" class="form-control" id="hora_apertura" name="hora_apertura" value="{{date('H:i:s')}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="monto_apertura">Monto</label>
                            <input class="form-control" id="monto_apertura" name="monto_apertura" value="">
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-success btn-apertura"><i class="fa fa-plus"></i> Insertar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



  <div class="table-responsive">
    <table id="table" class="table table-smtable table-bordered" style="font-size: 15px;">
        <thead class="text-center" style="background: #2551f81c; color: #575757; ">
            <tr>
                <th scope="col" width="8%" class="text-center">N°</th>
                <th scope="col" class="text-center">Fecha</th>
                <th scope="col" class="text-center">Hora</th>
                <th scope="col" class="text-center">monto</th>
                <th scope="col" class="text-center">Actual</th>
                <th scope="col" class="text-center">Usuario</th>
                <th scope="col" class="text-center">Estado</th>
                <th scope="col" class="text-center">Opciones</th>
                
            </tr>
        </thead>
    </table>
</div>

<div class="modal fade bs-example-modal-sm" id="modal_cerrar_caja" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="mySmallModalLabel">Cerra caja</h5>
            </div>
            <div class="modal-body">
                <span class="text-warning align-middle"
                    style="font-size: 24px; !important;"><i
                        class="ri-error-warning-fill"></i></span>
                <p class="d-inline-block"> ¿Desea cerrar su caja?</p>
  
                <div class="row text-right">
                    <div class="col-md-12">
                    <button class="btn btn-outline-secondary btn-sm mt-2 mr-2" data-dismiss="modal">Cancelar</button> 
                    <button class="btn btn-danger btn-sm mt-2 mr-2 btn_confirmar"><i class="fas fa-trash-alt"></i> Eliminar</button> 
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  



@endsection
@section('scripts')
@include('caja._myjs')
@include('caja.jsdatatables')
@endsection