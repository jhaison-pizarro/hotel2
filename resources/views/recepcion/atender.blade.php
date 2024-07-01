@extends('layouts.header')
@section('title_content_ol', 'Detalles de habitación')
@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="table-responsive" style=" overflow-x: hidden;">
            <table class="table table-sm table-bordered" id="tabla_clientes" style="width: 100%; max-width: 100%; font-size: 12px; padding: 5px;">
              <fieldset>
                  <legend style="font-size:12px;">Detalles de habitacion</legend>
                  <thead style="padding: 5px;">
                  </thead>
                  <tbody class="" style=".table td { line-height: 0.5; /* Reducir el espacio entre las celdas */}">
                      <tr>
                          <td class="text-left" style="width: 20%;">Nro</td>
                          <td class="text-left" style="">Nro {{ $habitaciones->numero }}</td>
                          <td class="text-left" style="width: 20%;">Categoria</td>
                          <td class="text-left" style="">{{ $habitaciones->nombre }}</td>
                      </tr>
                      <tr>
                          <td class="text-left" style="width: 20%;">Detalles</td>
                          <td class="text-left" style="">{{ $habitaciones->descripcion }}</td>
                          <td class="text-left" style="width: 20%;">Piso</td>
                          <td class="text-left" style="">{{ $habitaciones->denominacion }}</td>
                      </tr>
                  </tbody>
              </fieldset>
          </table>
      </div>
     </div>
</div>

<div class="row">
  <div class="col-lg-6">
    <fieldset style="border: 1px solid #ddd; border-radius:5px; padding:20px; margin-top:20px ">
      <legend style="border: 1px solid #ddd; border-radius:5px 10px; padding:5px;  font-size:12px;">Detalle cliente</legend>
      <div class="row">
        <div class="col-lg-10">
          <form style="font-size:12px">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">DNI</label>
                <div class="col-sm-10">
                    <div class="input-group">
                        <input type="text" class="form-control" id="dni_cli" name="dni_cli" placeholder="DNI">
                        <div class="input-group-append">
                          <a type="button" style="background-color:#00a65a; color:white"class="input-group-addon" data-toggle="modal"  data-target="#registrar_cliente">
                            [+] Nuevo
                         </a>
                        </div>
                    </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Tipo </label>
                <div class="col-sm-10">
                  <select type="text" class="form-control" id="tipo_documento" name="tipo_documento">
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
                        <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" placeholder="Nombre">
                    </div>
                </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Apellido</label>
              <div class="col-sm-10">
                  <div class="input-group">
                      <input type="email" class="form-control" id="apellido_cliente" name="apellido_cliente" placeholder="Apellido">
                  </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">E-mail</label>
              <div class="col-sm-10">
                  <div class="input-group">
                      <input type="email" class="form-control" id="correo_cliente" name="correo_cliente" placeholder="E-mail">
                  </div>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Telefono</label>
              <div class="col-sm-10">
                  <div class="input-group">
                      <input type="email" class="form-control" id="telefono_cliente" name="telefono_cliente" placeholder="Telefono">
                  </div>
              </div>
            </div>
          </form>
         </div>
      </div>

    </fieldset>
  </div>
  <div class="col-lg-6">
    <fieldset style="border: 1px solid #ddd; border-radius:5px; padding:20px; margin-top:20px ">
      <legend style="border: 1px solid #ddd; border-radius:5px 10px; padding:5px;  font-size:12px;">Detalle reservacion</legend>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group has-feedback">
            <label class="control-label">Fecha entrada</label>
            <input class="form-control" type="date" id="entrada" name="entrada" value="{{ date('Y-m-d') }}" readonly>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group has-feedback">
            <label class="control-label">Fecha salida</label>
            <input class="form-control"  id="salidas" name="salidas"type="date" oninput="calcularPrecio()">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group has-feedback">
            <label class="control-label">Precio</label>
            <input class="form-control" id="precio" name="precio" placeholder="S/" type="text" value="{{ $habitaciones->precio }}.00">
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group has-feedback">
            <label class="control-label">Adelanto <small class="text-danger"> (Opcional)</small></label>
            <input class="form-control" name="adelanto" id="adelanto" placeholder="S/" type="text">
          </div>
        </div>
       
        <div class="col-md-12">
          <div class="form-group has-feedback">
            <label class="control-label">Descripcion <small class="text-danger"> (Opcional)</small></label>
            <textarea class="form-control" id="observaciones" name="observaciones" rows="4" ></textarea>
          </div>
        </div>
        

    </fieldset>
  </div>
</div>
<br>
<div class="pull-right o_o_margin_bt">
  <button type="button" class="btn btn-danger" data-dismiss="modal">
    <i class="fa fa-times"></i> Cancelar
</button>
  <button type="submit" class="btn btn-success  btn_save_recepcion">
      <i class="fa fa-save "></i> Registrar
  </button>
 
</div>


<!--REGISTRAR MODAL CLIENTE-->
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
                                <input type="text" class="form-control" id="dni_cli_re" name="dni_cli" placeholder="DNI">
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



@endsection
@section('scripts')
@include('recepcion.atenderjs')
@include('clientes._myjs')
@endsection