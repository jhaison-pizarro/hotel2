
@extends('layouts.header')
@section('title_content_ol', 'Registro de usuarios')
@section('content')

  

<div class="d-flex no-block justify-content-end align-items-center">
    <button class="btn btn-primary btn-sm mt-2 mr-2" data-toggle="modal" data-target="#registrar_usuario"><i class="fa fa-plus-circle"></i> Nuevo usario</button> 
</div>
<br>
<div class="table-responsive">
    <table id="usuarios_table" class="table table-smtable table-bordered" style="font-size: 13px;">
        <thead class="text-center" style="background: #2551f81c; color: #575757; ">
            <tr>
                <th scope="col" width="8%" class="text-center">N°</th>
                <th scope="col" class="text-center">Nª Documento</th>
                <th scope="col" class="text-center">Nombres</th>
                <th scope="col" class="text-center">Celular</th>
                <th scope="col" class="text-center">Direccion</th>
                <th scope="col" class="text-center">Estado</th>
                <th scope="col" width="10%" class="text-center">Acciones</th>
            </tr>
        </thead>
    </table>
</div>
<!-- Modal registrar usuario -->
<div class="modal fade bd-example-modal-lg" id="registrar_usuario" tabindex="" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding:5px; display:block">
            <div class="card-header bg-blue">
                <h5 class="text-white m-b-0">Registrar Usuario</h5>
            </div>
         
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="form_usuarios">
                @csrf
                <div class="form-group row">
                  <label for="exampleInputuname3" class="col-sm-3 control-label">Nombre<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <input class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" type="text" >
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputuname3" class="col-sm-3 control-label">Dirección<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <div class="input-group">
                       <input class="form-control" id="direccion" name="direccion" placeholder="Direccion" type="text">
                      </div>
                    </div>
                  </div>
                <div class="form-group row">
                    <label for="web" class="col-sm-3 control-label">N° Documento<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <div class="input-group">
                       <input class="form-control" name="documento" id="documento" placeholder="DNI" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                      </div>
                    </div>
                </div>
                <div class="form-group row">
                  <label for="exampleInputEmail3" class="col-sm-3 control-label">Telefono<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <input class="form-control" id="telefono" name="telefono" placeholder="Telefono" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="web" class="col-sm-3 control-label">Usuario<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                     <input class="form-control" id="usuario" name="usuario" placeholder="Usuario" type="text">
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword4" class="col-sm-3 control-label">Password<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <input class="form-control" id="contraseña" name="contraseña" placeholder="Password" type="password">
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword4" class="col-sm-3 control-label">Rol<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <select class="form-control" id="rol" name="rol">
                        @foreach ($roles as $item)
                        <option value="{{ $item->id }}">{{ $item->descripcion }}</option>  
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
             </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-close"></i> Cerrar</button>
          <button type="button" class="btn btn-primary btn_save_usuarios"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div> 

<div class="modal fade bs-example-modal-sm" id="modal_delete_usuario" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                  <button class="btn btn-danger btn-sm mt-2 mr-2 btn_confirmar_usuario"><i class="fas fa-trash-alt"></i> Eliminar</button> 
                  </div>
              </div>
          </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Modal editar usuarios-->
<div class="modal fade bd-example-modal-lg" id="edit_form_usuarios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding:5px; display:block">
            <div class="card-header bg-blue">
                <h5 class="text-white m-b-0">Editar Usuario</h5>
            </div>
         
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="edit_form_usuarios">
                @csrf
                <div class="form-group row">
                  <label for="exampleInputuname3" class="col-sm-3 control-label">Nombre<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="ti-user"></i></div>
                      <input type="text" class="d-none" name="idusuario" id="idusuario" >
                      <input class="form-control" id="edit_nombre" name="edit_nombre" placeholder="" type="text" >
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputuname3" class="col-sm-3 control-label">Dirección<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <div class="input-group-addon"><i class="ti-world"></i></div>
                        <input class="form-control" id="edit_direccion" name="edit_direccion" placeholder="" >
                      </div>
                    </div>
                  </div>
                <div class="form-group row">
                    <label for="web" class="col-sm-3 control-label">N° Documento<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <div class="input-group">
                        <div class="input-group-addon"><i class="icon-wallet"></i></div>
                        <input class="form-control" name="edit_documento" id="edit_documento" placeholder="" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                      </div>
                    </div>
                </div>
                <div class="form-group row">
                  <label for="exampleInputEmail3" class="col-sm-3 control-label">Telefono<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="icon-phone"></i></div>
                      <input class="form-control" id="edit_telefono" name="edit_telefono" placeholder="" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="web" class="col-sm-3 control-label">Usuario<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="icon-settings"></i></div>
                      <input class="form-control" id="edit_usuario" name="edit_usuario" placeholder="" type="text">
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword4" class="col-sm-3 control-label">Password<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="ti-lock"></i></div>
                      <input class="form-control" id="edit_contraseña" name="edit_contraseña" placeholder="Password" type="password">
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword4" class="col-sm-3 control-label">Rol<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <select class="form-control" id="idrol" name="idrol">
                        @foreach ($roles as $item)
                        <option value="{{ $item->id }}">{{ $item->descripcion }}</option>  
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
             </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-close"></i> Cerrar</button>
          <button type="button" class="btn btn-primary btn_update_usuario"><i class="fa fa-save"></i> Actualizar</button>
        </div>
      </div>
    </div>
</div>

<!--modal eliminar usuarios -->



@endsection
@section('scripts')
    @include('usuarios._myjs') 
    @include('usuarios.jsusuarios')      
@endsection