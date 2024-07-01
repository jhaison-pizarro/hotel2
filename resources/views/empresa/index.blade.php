@extends('layouts.header')
@section('title_content_ol', 'Configuracion de empresa')
@section('content')
<div class="card-header bg-blue">
    <h5 class="text-white m-b-0">Datos de empresa</h5>
</div>
<br>
<form id="from_empresa" method="POST" enctype="multipart/form-data">
  @csrf
    <div class="row">
      <div class="col-md-6">
        <div class="form-group has-feedback">
          <label class="control-label">Nombre de hotel</label>
          <input class="form-control" name="nombre_empresa" id="nombre_empresa" placeholder="Nombre" type="text" value="{{ $empresa->nombre }}">
          <span class="fa fa-user form-control-feedback" aria-hidden="true"></span> </div>
      </div>
      <div class="col-md-6">
        <div class="form-group has-feedback">
          <label class="control-label">Direcciòn</label>
          <input class="form-control" name="direccion_empresa" id="direccion_empresa" placeholder="Direccion" type="text" value="{{ $empresa->direccion }}">
          <span class="fa fa-user form-control-feedback" aria-hidden="true"></span> </div>
      </div>
      <div class="col-md-6">
        <div class="form-group has-feedback">
          <label class="control-label">Telefono</label>
          <input class="form-control" name="telefono_empresa" id="telefono_empresa" placeholder="Telefono" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{ $empresa->telefono }}">
          <span class="fa fa-phone  form-control-feedback" aria-hidden="true"></span> </div>
      </div>
      <div class="col-md-6">
        <div class="form-group has-feedback">
          <label class="control-label">E-mail</label>
          <input class="form-control" name="email_empresa" id="email-empresa" placeholder="E-mail" type="text" value="{{ $empresa->correo }}">
          <span class="fa fa-envelope-o form-control-feedback" aria-hidden="true"></span> </div>
      </div>
      <div class="col-md-6">
        <div class="form-group has-feedback">
          <label class="control-label">RUC</label>
          <input class="form-control" name="ruc_empresa" id="ruc_empresa" placeholder="Ruc" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{ $empresa->ruc }}">
          <span class="fa fa-briefcase form-control-feedback" aria-hidden="true"></span> </div>
      </div>
      <div class="col-md-6">
        <div class="form-group has-feedback">
          <label class="control-label">Sitio Web</label>
          <input class="form-control" name="web_empresa" id="web_empresa" placeholder="https://" type="text" value="{{ $empresa->web }}">
          <span class="fa fa-globe form-control-feedback" aria-hidden="true"></span> </div>
      </div>
      <div class="col-md-6">
        <div class="form-group has-feedback">
          <img style="width: 100px" src="{{ asset('logo_empresa/' . $empresa->logo)}} ">
       </div>
      </div>
     
      <div class="col-md-12">
        <div class="form-group has-feedback">
          <label class="custom-file center-block block">Logo de empresa</label>
            <input id="file" name="logo_empresa" id="logo_empresa" class="" type="file">
   
        </div>
      </div>
     
       </div>
       <div class="d-flex justify-content-end float-right">
        <button class="btn btn-success float-right btn_save_empresa">Guardar</button>
      </div>
    </form>

@endsection
@section('scripts')
@include('empresa._myjs')
@endsection