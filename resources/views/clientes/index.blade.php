
@extends('layouts.header')
@section('title_content_ol', 'Catalogo de clientes')
@section('content')
<div class="card-header bg-blue">
    <h5 class="text-white m-b-0">Lista de clientes</h5>
</div>
<div class="d-flex no-block justify-content-end align-items-center">
    <button class="btn btn-primary btn-sm mt-2 mr-2" data-toggle="modal" data-target="#registrar_cliente"><i class="fa fa-plus-circle"></i> Nuevo cliente</button> 
</div>
<br>
<div class="table-responsive">
    <table id="table_clientes" class="table table-smtable table-bordered" style="font-size: 15px;">
        <thead class="text-center" style="background: #2551f81c; color: #575757; ">
            <tr>
                <th scope="col" width="8%" class="text-center">N°</th>
                <th scope="col" class="text-center">Nª DNI</th>
                <th scope="col" class="text-center">Nombre</th>
                <th scope="col" class="text-center">E-mail</th>
                <th scope="col" class="text-center">Celular</th>
                <th scope="col" class="text-center">Acciones</th>
                
            </tr>
        </thead>
    </table>
</div>


<div class="modal fade bd-example-modal-lg" tabindex="-1" id="registrar_cliente" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
      <h5>Registrar cliente [+]</h5>
    </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                  <form style="font-size:12px">
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">DNI</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" class="form-control" id="dni_cli_re" name="dni_cli_re" placeholder="DNI">
                                <div class="input-group-append">
                                  <a type="button" style="background-color:#00a65a; color:white"class="input-group-addon btn_reniec_re">
                                    reniec
                                 </a>
                                 <a type="button" style="background-color:#00a65a; color:white"class="input-group-addon d-none btn_reniec_disable_re">
                                   buscando..
                                </a>
                                </div>
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Tipo </label>
                        <div class="col-sm-10">
                          <select type="text" class="form-control" id="tipo_documento_re" name="tipo_documento_re">
                            <option>[Seleccione]</option>
                                @foreach($tipo_documento as $tipo_documentos)
                                <option value="{{ $tipo_documentos->idtipo_documento }}">{{ $tipo_documentos->descripcion }}</option>  
                                @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" class="form-control" id="nombre_cliente_re" name="nombre_cliente_re" placeholder="Nombre">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Apellido</label>
                      <div class="col-sm-10">
                          <div class="input-group">
                              <input type="email" class="form-control" id="apellido_cliente_re" name="apellido_cliente_re" placeholder="Apellido">
                          </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">E-mail</label>
                      <div class="col-sm-10">
                          <div class="input-group">
                              <input type="email" class="form-control" id="correo_cliente_re" name="correo_cliente_re" placeholder="E-mail">
                          </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Telefono</label>
                      <div class="col-sm-10">
                          <div class="input-group">
                              <input type="email" class="form-control" id="telefono_cliente_re" name="telefono_cliente_re" placeholder="Telefono">
                          </div>
                      </div>
                    </div>
                  </form>
                 </div>
              </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-close"></i> Cerrar</button>
        <button type="button" class="btn btn-primary btn_save_cliente"><i class="fa fa-save"></i> Guardar</button>
      </div>
    
    </div>
  </div>
</div>
</div>

<div class="modal fade bs-example-modal-sm" id="modal_delete_cliente" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                  <button class="btn btn-danger btn-sm mt-2 mr-2 btn_delete_cliente"><i class="fas fa-trash-alt"></i> Eliminar</button> 
                  </div>
              </div>
          </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class="modal fade bd-example-modal-lg" tabindex="-1" id="edit_cliente" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
    <div class="modal-header">
      <h5>Actualizar cliente [+]</h5>
    </div>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                  <form style="font-size:12px">
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">DNI</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" class="form-control" id="edit_dni_cliente" name="edit_dni_cliente" placeholder="DNI">
                                
                            </div>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Tipo </label>
                        <div class="col-sm-10">
                          <select type="text" class="form-control" id="edit_tipo_documento" name="edit_tipo_documento">
                            <option value="0">[Seleccione]</option>
                                @foreach($tipo_documento as $tipo_documentos)
                                <option value="{{ $tipo_documentos->idtipo_documento }}">{{ $tipo_documentos->descripcion }}</option>  
                                @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <input type="text" class="form-control" id="edit_cliente_nombre" name="edit_cliente_nombre" placeholder="Nombre">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Apellido</label>
                      <div class="col-sm-10">
                          <div class="input-group">
                              <input type="email" class="form-control" id="edit_apellido_cliente" name="edit_apellido_cliente" placeholder="Apellido">
                          </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">E-mail</label>
                      <div class="col-sm-10">
                          <div class="input-group">
                              <input type="email" class="form-control" id="edit_correo_cliente" name="edit_correo_cliente" placeholder="E-mail">
                          </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Telefono</label>
                      <div class="col-sm-10">
                          <div class="input-group">
                              <input type="email" class="form-control" id="edit_telefono_cliente" name="edit_telefono_cliente" placeholder="Telefono">
                          </div>
                      </div>
                    </div>
                  </form>
                 </div>
              </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-close"></i> Cerrar</button>
        <button type="button" class="btn btn-primary  btn_edit_cliente"><i class="fa fa-save"></i> Actualizar</button>
      </div>
    
    </div>
  </div>
</div>
</div>

<!-- MODAL EDIT -->



@endsection
@section('scripts')
@include('clientes._myjs')
@include('clientes.jsdatatables')
@endsection