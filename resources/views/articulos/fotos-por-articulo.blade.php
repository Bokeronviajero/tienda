@extends('layouts.main-layout')
@section ('page-title','Lista de articulos')
@section ('content-area')
<h1>Lista fotos por articulos<h1>
<h5>
<table class="table">
<thead>
  <tr>
  <th>Id</th>
  <th>isbn</th>
  <th>Articulo</th>
</tr>
</thead>
<tbody>
  @foreach ($articulos as $articulo)
<tr>
    <td>{{ $articulo -> id }}</td>
    <td>{{ $articulo -> isbn }}</td> 
    <td>
      <a href="{{ route('articulos.show', ['articulo'=>$articulo])}}">
      {{ $articulo -> nombre }}
      </a>
    </td> 
    <td>
    
    </form>
    
    @endsection