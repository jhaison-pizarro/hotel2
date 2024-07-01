@extends('layouts.header')
@section('title_content_ol', 'Registro de roles')
@section('content')

<div class="d-flex no-block justify-content-end align-items-center">
    <button class="btn btn-primary btn-sm mt-2 mr-2" data-toggle="modal" data-target="#nuevorol"><i class="fa fa-plus-circle"></i> Nuevo rol</button> 
</div>
<br>
<div class="table-responsive">
    <table id="table" class="table table-smtable table-bordered" style="font-size: 13px;">
        <thead class="text-center" style="background: #2551f81c; color: #575757; ">
            <tr>
                <th scope="col" width="8%" class="text-center">N°</th>
                <th scope="col" class="text-center">Descripcion</th>
                <th scope="col" class="text-center">Estado</th>
                <th scope="col" width="10%" class="text-center">Acciones</th>
            </tr>
        </thead>
    </table>
</div>


<div class="modal fade bd-example-modal-lg" id="nuevorol" tabindex="" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding:5px; display:block">
            <div class="card-header bg-blue">
                <h5 class="text-white m-b-0">Registrar rol</h5>
            </div>
         
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="form_rol">
                @csrf
                
                <div class="form-group row">
                    <label for="exampleInputuname3" class="col-sm-3 control-label">Descripcion<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <div class="input-group">
                       <input class="form-control" id="descripcion" name="descripcion" placeholder="Rol" type="text">
                      </div>
                    </div>
                  </div>
               
             </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-close"></i> Cerrar</button>
          <button type="button" class="btn btn-primary btn_save_roles"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div> 
<div class="modal fade bd-example-modal-lg" id="editrol" tabindex="" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding:5px; display:block">
          <div class="card-header bg-blue">
              <h5 class="text-white m-b-0">Editar rol</h5>
          </div>
       
      </div>
      <div class="modal-body">
          <form class="form-horizontal" id="form_rol">
              @csrf
              
              <div class="form-group row">
                  <label for="exampleInputuname3" class="col-sm-3 control-label">Descripcion<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                     <input class="form-control" id="edit_descripcion" name="edit_descripcion" placeholder="Rol" type="text">
                    </div>
                  </div>
                </div>
             
           </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-close"></i> Cerrar</button>
        <button type="button" class="btn btn-primary btn_edit_roles"><i class="fa fa-save"></i> Actualizar</button>
      </div>
    </div>
  </div>
</div>
</div> 


<div class="modal fade bs-example-modal-sm" id="modal_delete_rol" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
@include('roles._myjs');
@endsection