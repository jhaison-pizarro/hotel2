
@extends('layouts.header')
@section('title_content_ol', 'Tipos de habitaciones')
@section('content')
<div class="card-header bg-blue">
    <h5 class="text-white m-b-0">Listado tipo de habitaciones</h5>
</div>
<div class="d-flex no-block justify-content-end align-items-center">
    <button class="btn btn-primary btn-sm mt-2 mr-2" data-toggle="modal" data-target="#registrar_tipo_hab"><i class="fa fa-plus-circle"></i> Nuevo tipo</button> 
</div>
<br>
<div class="table-responsive">
    <table id="table_tipo_habitaciones" class="table table-smtable table-bordered" style="font-size: 15px;">
        <thead class="text-center" style="background: #2551f81c; color: #575757; ">
            <tr>
                <th scope="col" width="8%" class="text-center">N°</th>
                <th scope="col" class="text-center">Tipo de habitacion</th>
                <th scope="col" class="text-center">Descripcion</th>
                <th scope="col" class="text-center">Acciones</th>
                
            </tr>
        </thead>
    </table>
</div>


<!--Modal registrar tipo habitaciones -->
<div class="modal fade bd-example-modal-lg" id="registrar_tipo_hab" tabindex="" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding:5px; display:block">
            <div class="card-header bg-blue">
                <h5 class="text-white m-b-0">Registre tipo de habitacion</h5>
            </div>
         
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="form_usuarios">
                @csrf
                <div class="form-group row">
                  <label for="exampleInputuname3" class="col-sm-3 control-label">Denominacion<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                  
                      <input class="form-control" id="denominacion_tipo" name="denominacion_tipo" placeholder="Denominaciòn" type="text">
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputuname3" class="col-sm-3 control-label">Descripcion<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <div class="input-group">
                       <textarea class="form-control" id="descripcion_tipo" name="descripcion_tipo" placeholder="Descripcion" type="text"></textarea>
                      </div>
                    </div>
                  </div>
                
            
             </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-close"></i> Cerrar</button>
          <button type="button" class="btn btn-primary btn_save_tipo_habitacion"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div> 

<!-- EDITAR TIPO_HABITACION -->
<div class="modal fade bd-example-modal-lg" id="edit_tipo_hab" tabindex="" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding:5px; display:block">
            <div class="card-header bg-blue">
                <h5 class="text-white m-b-0">Editar tipo de habitacion</h5>
            </div>
         
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="form_usuarios">
                @csrf
                <div class="form-group row">
                  <label for="exampleInputuname3" class="col-sm-3 control-label">Denominacion<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                     <input class="form-control" id="edit_denominacion_tipo" name="edit_denominacion_tipo" placeholder="Denominaciòn" type="text" style="text-transform:uppercase ">
                      <input class="d-none" id="idtipo" name="idtipo">
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputuname3" class="col-sm-3 control-label">Descripcion<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <div class="input-group">
                       <textarea class="form-control" id="edit_descripcion_tipo" name="edit_descripcion_tipo" placeholder="Descripcion" type="text" ></textarea>
                      </div>
                    </div>
                  </div>
                
            
             </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-close"></i> Cerrar</button>
          <button type="button" class="btn btn-primary btn_edit_tipo_habitacion"><i class="fa fa-save"></i> Actualizar</button>
        </div>
      </div>
    </div>
  </div>
</div> 

<!--MODAL DELETE TIPO HABITACION-->
<div class="modal fade bs-example-modal-sm" id="modal_delete_tipo_hab" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title mt-0" id="mySmallModalLabel">Eliminar</h5>
          </div>
          <div class="modal-body">
              <span class="text-warning align-middle"
                  style="font-size: 24px; !important;"><i
                      class="ri-error-warning-fill"></i></span>
              <p class="d-inline-block"> ¿Desea eliminar el registro?</p>

              <div class="row text-right">
                  <div class="col-md-12">
                  <button class="btn btn-outline-secondary btn-sm mt-2 mr-2" data-dismiss="modal">Cancelar</button> 
                  <button class="btn btn-danger btn-sm mt-2 mr-2 btn_confirmar_delete"><i class="fas fa-trash-alt"></i> Eliminar</button> 
                  </div>
              </div>
          </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('scripts')
@include('tipo_habitaciones._myjs');
@include('tipo_habitaciones.jsdatatable');
@endsection