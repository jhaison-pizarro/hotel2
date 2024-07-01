
@extends('layouts.header')
@section('title_content_ol', 'Lista de productos')
@section('content')
<div class="d-flex no-block justify-content-end align-items-center">
    <button class="btn btn-primary btn-sm mt-2 mr-2" data-toggle="modal" data-target="#registrar_productos"><i class="fa fa-plus-circle"></i> Nuevo producto</button> 
</div>
<br>
<div class="table-responsive">
    <table id="productos_table" class="table table-smtable table-bordered" style="font-size: 12px; ">
        <thead class="text-center" style="background: #2551f81c; color: #575757; ">
            <tr>
                <th scope="col" width="8%" class="text-center">N°</th>
                <th scope="col" class="text-center">Nombre Prodcuto</th>
                <th scope="col" class="text-center">Categoria</th>
                <th scope="col" class="text-center">Precio</th>
                <th scope="col" class="text-center">Fecha</th>
                <th scope="col" class="text-center">Stock</th>
                <th scope="col" width="10%" class="text-center">Acciones</th>
            </tr>
        </thead>
    </table>
</div>

<!--Modal insertar productos-->

<div class="modal fade bd-example-modal-lg" id="registrar_productos" tabindex="" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header" style="padding:5px; display:block">
            <div class="card-header bg-blue">
                <h5 class="text-white m-b-0">Registrar producto</h5>
            </div>
         
        </div>
        <div class="modal-body">
            <form class="form-horizontal" id="form_productos">
                @csrf
                <div class="form-group row">
                  <label for="exampleInputuname3" class="col-sm-3 control-label">Producto<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                     <input class="form-control" id="nombre" name="nombre" placeholder="Nombre completo" type="text">
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                    <label for="exampleInputuname3" class="col-sm-3 control-label">Precio<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <div class="input-group">
                         <input class="form-control" id="precio" name="precio" placeholder="Precio" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                      </div>
                    </div>
                  </div>
                <div class="form-group row">
                    <label for="web" class="col-sm-3 control-label">Stock<span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <div class="input-group">
                       
                        <input class="form-control" name="stock" id="stock" placeholder="Stock" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                      </div>
                    </div>
                </div>
                <div class="form-group row">
                  <label for="exampleInputEmail3" class="col-sm-3 control-label">Categoria<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <select class="form-control" id="categoria" name="categoria" type="text">
                        <option value="0">Seleccione</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->idcategoria }}">{{ $categoria->denominacion }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
               
                <div class="form-group row">
                  <label for="inputPassword4" class="col-sm-3 control-label">Fecha<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <input class="form-control" id="fecha" name="fecha" placeholder="" type="date" value="{{ date('Y-m-d') }}">
                    </div>
                  </div>
                </div>
             </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-close"></i> Cerrar</button>
          <button type="button" class="btn btn-primary btn_save_producto"><i class="fa fa-save"></i> Guardar</button>
        </div>
      </div>
    </div>
  </div>
</div> 



<div class="modal fade bd-example-modal-lg" id="edit_productos" tabindex="" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding:5px; display:block">
          <div class="card-header bg-blue">
              <h5 class="text-white m-b-0">Editar Producto</h5>
          </div>
       
      </div>
      <div class="modal-body">
          <form class="form-horizontal" id="edit_productos">
              @csrf
              <div class="form-group row">
                <label for="exampleInputuname3" class="col-sm-3 control-label">Producto<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-building-o"></i></div>
                    <input class="form-control" id="edit_nombre" name="edit_nombre" placeholder="Nombre completo" type="text" style="text-transform:uppercase ">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                  <label for="exampleInputuname3" class="col-sm-3 control-label">Precio<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="fa fa-tags"></i></div>
                      <input class="form-control" id="edit_precio" name="edit_precio" placeholder="Precio" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                  </div>
                </div>
              <div class="form-group row">
                  <label for="web" class="col-sm-3 control-label">Stock<span class="text-danger">*</span></label>
                  <div class="col-sm-9">
                    <div class="input-group">
                      <div class="input-group-addon"><i class="icon-wallet"></i></div>
                      <input class="form-control" name="edit_stock" id="edit_stock" placeholder="Stock" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    </div>
                  </div>
              </div>
              <div class="form-group row">
                <label for="exampleInputEmail3" class="col-sm-3 control-label">Categoria<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-gears"></i></div>
                    <select class="form-control" id="edit_categoria" name="edit_categoria" type="text">
                      <option value="0"">Seleccione</option>
                      @foreach($categorias as $categoria)
                          <option value="{{ $categoria->idcategoria }}">{{ $categoria->denominacion }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
             
              <div class="form-group row">
                <label for="inputPassword4" class="col-sm-3 control-label">Fecha<span class="text-danger">*</span></label>
                <div class="col-sm-9">
                  <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input class="form-control" id="edit_fecha" name="edit_fecha" placeholder="" type="date" value="{{ date('Y-m-d') }}">
                  </div>
                </div>
              </div>
           </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="icon-close"></i> Cerrar</button>
        <button type="button" class="btn btn-primary btn_edit_producto"><i class="fa fa-save"></i> Guardar</button>
      </div>
    </div>
  </div>
</div>
</div>


<!-- Modal eliminar el producto -->
<div class="modal fade bs-example-modal-sm" id="modal_delete_producto" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                  <button class="btn btn-danger btn-sm mt-2 mr-2 eliminar"><i class="fas fa-trash-alt"></i> Eliminar</button> 
                  </div>
              </div>
          </div>
      </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('scripts')
@include('productos._myjs')
@include('productos.jsdatatable')
@endsection
