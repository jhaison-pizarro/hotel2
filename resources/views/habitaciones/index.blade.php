@extends('layouts.header')
@section('title_content_ol', 'Habitaciones')
@section('content')
<div class="card-header bg-blue">
    <h5 class="text-white m-b-0">Listado  de habitaciones</h5>
</div>
<div class="d-flex no-block justify-content-end align-items-center">
    <button class="btn btn-primary btn-sm mt-2 mr-2" data-toggle="modal" data-target="#registrar_habitaciones"><i class="fa fa-plus-circle"></i> Nueva habitacion</button> 
</div>
<br>
<div class="table-responsive">
    <table id="table_habitaciones" class="table table-smtable table-bordered" style="font-size: 12px;">
        <thead class="text-center" style="background: #2551f81c; color: #575757; ">
            <tr>
                <th scope="col" width="8%" class="text-center">N°</th>
                <th scope="col" class="text-center">Nª habitacion</th>
                <th scope="col" class="text-center">Tipo</th>
                <th scope="col" class="text-center">Nivel</th>
                <th scope="col" class="text-center">Estado</th>
                <th scope="col" class="text-center">Acciones</th>
                
            </tr>
        </thead>
    </table>
</div>


<!--MODAL REGISTRAR HABITACION -->
<!--Modal registrar tipo habitaciones -->
<div class="modal fade bd-example-modal-lg" id="registrar_habitaciones" tabindex="" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding:5px; display:block">
            <div class="card-header bg-blue">
                <h5 class="text-white m-b-0">Registrar habitacion</h5>
            </div>
         
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="form_usuarios">
                @csrf
                <div class="form-group row">
                  <label for="exampleInputuname3" class="col-sm-3 control-label">N° Habitacion<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <input class="form-control" id="nro_habitacion" name="nro_habitacion" placeholder="N°" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputuname3" class="col-sm-3 control-label">Precio<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <div class="input-group">
                       <input class="form-control" id="precio_habitacion" name="precio_habitacion" placeholder="Precio" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                      </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputuname3" class="col-sm-3 control-label">Nivel<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <div class="input-group">
                       <select class="form-control" id="nivel_habitacion" name="nivel_habitacion" placeholder="Descripcion" type="text">
                        <option>Seleccione</option>
                        @foreach ($niveles  as $nivel )
                            <option value="{{ $nivel->idnivel }}">{{ $nivel->denominacion }}</option>
                        @endforeach

                       </select>
                      </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputuname3" class="col-sm-3 control-label">Tipo habitacion<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <div class="input-group">
                       <select class="form-control" id="tipo_habitacion" name="tipo_habitacion" placeholder="Descripcion" type="text">
                        <option>Seleccione</option>
                        @foreach($tipo_habitacion as $tipo_habitaciones)
                            <option value="{{ $tipo_habitaciones->idtipo }}">{{ $tipo_habitaciones->denominacion }}</option>
                        @endforeach
                       </select>
                      </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputuname3" class="col-sm-3 control-label">Tipo habitacion<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <div class="input-group">
                      <textarea class="form-control" id="descripcion_hab" name="descripcion_hab" placeholder="Describe" type="text"></textarea>
                      </div>
                    </div>
                </div>
                
            
             </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-close"></i> Cerrar</button>
          <button type="button" class="btn btn-primary btn_save_habitacion"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div> 

@endsection

@section('scripts')
@include('habitaciones._myjs')
@include('habitaciones.jsdatatables')
@endsection