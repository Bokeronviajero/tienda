@extends('layouts.main-layout')
@section ('page-title','Nuevo articulo ')
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
<h5>
<div class="container">
  <h1>Nuevo Articulo</h1>
  <!-- aqui creo el formulario   -->
  
    <form action="{{route('articulos.store')}}" enctype="multipart/form-data" method="post">
    @csrf
    @include("articulos.form-articulo",['FormType'=>'create'])
    {{-- *************** boton enviar y volver ********** --}}
    <div class="button-group">
        <input class="btn btn-primary btn-small" type="submit" value="Enviar">
        <a href="{{route('articulos.index')}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Volver</a>
    </div>
      <!-- ***********fin boton enviar y volver -->
    </form>
  
</div>
@endsection
