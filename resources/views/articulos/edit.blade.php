@extends('layouts.main-layout')
@section ('page-title','Editar articulo '.$articulo->nombre)    
@section ('content-area')
<!-- validacion de errores -->
@if ($errors->any())
    <div class="alert alert-danger">
    <ul>
    @foreach ($errors->all() as $error)
        <li>
            <strong>{{$error}}</strong>           
        </li>
    @endforeach    
    </ul>
    </div>
@endif    
<!-- ******************************** -->
<!-- EDITAR ARTICULO -->
<div class="container">
  <h1>Editar Articulo <span style="color:blue">{{$articulo->nombre}}</span><h1>
  </h1>
  <div class="form-group">
    @include("articulos.form-articulo",['FormType'=>'edit'])
  </div>
  <!-- aqui creo el formulario   -->
  <div class="form-group">
    <form action="{{route('articulos.update',['articulo'=>$articulo])}}" method="post" enctype="multipart/form-data" class="form-control">
      @method('PUT')
      @csrf
      <!-- aqui poner los botones de editar -->
      <!-- fin boton añadir foto ***************-->
    <div class="button-group">
      <input class="btn btn-primary btn-small" type="submit" value="Enviar">
      <a href="{{route('articulos.index')}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Volver</a>
    </div>
    <!-- ***********fin boton enviar -->
    </form>
</div>
</div>
@endsection