@extends('layouts.main-layout')
@section ('page-title','Detalles del articulo')
@section ('content-area')
<!-- validacion de errores -->
@if ($errors->any())
    <div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li><strong>{{$error}}</strong></li>
        @endforeach    
    </ul>
    </div>
@endif   

<h3>Detalles del articulo <span style="color:blue">{{$articulo->nombre}}</span></h3>
<h5>
    <form action="{{route('articulos.show',$articulo->id)}}" method="post"  class="form-control">
    @include("articulos.form-articulo",['FormType'=>'show'])
        <div class="button-group">
        <a href="{{route('articulos.index')}}" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Volver</a>
        </div>
    </form>
</h5>
<form action="">
<div class="form-group">
    {{-- ******************************** --}}
    <thead>
        <tr>
        <th>Id</th>
        <th>isbn</th>
        <th>Foto</th>
        <th>Nombre</th>
        <th>Articulo</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($photos as $photo)
        <tr>
            <td>{{ $articulo -> id }}</td>
            <td>{{ $articulo -> isbn }}</td>
        
            @if (isset($articulo->photos()->first()->path) != null)
            <td><img src="{{$articulo->photos()->first()->path}}" width="80" height="" alt=""></td>
            <td>{{$articulo->photos()->first()->name}}</td>
            @else
            <td>
            <img src="{{'default_photo.jpg'}}" width="80" height="" alt="">
            </td>
            <td></td>
            @endif
    @endforeach
    {{-- ********************** --}}
    </div>
</form>
@endsection
