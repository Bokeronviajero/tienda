@extends('layouts.main-layout')
@section ('page-title','Lista de articulos')
@section ('content-area')
<h1>Lista global de articulos<h1>
<h5>
<table class="table">
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
  @foreach ($articulos as $articulo)
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
    
    <td> 
    <a href="{{ route('articulos.show', $articulo->id)}}">
      {{ $articulo -> nombre }}
      </a>
    </td> 
    <td>
    <!-- aqui ponemos boton de borrar por post ***** AZUL *****-->
    <td>
        <div class="form-group">
            <form action="{{ route('articulos.destroy',$articulo->id)}}" method="post">
            @method ('DELETE')
            @csrf
            <button type="submit" class="btn btn-primary">BORRAR</button>
            </form>
        </div>
    </td>
    <!-- Button trigger modal  1 ****** ROJO ********-->
    <td>            
    <button type="button" class="btn btn-danger" id="btn_confirm" data-toggle="modal" data-target="#delete_modal_{{$articulo->id}}">
    Borrar con modal
    </button>
    </td>
    <td>
    
    <!-- formulario para la eliminacion -->
    <form id="delete_form" action="{{ route('articulos.destroy',$articulo->id)}}" method="post">
    @method ('DELETE')
    @csrf
    </form>
    <!-- Modal ROJO ******* MODAL PARA ELIMINACION **************************-->
    <div class="modal fade" id="delete_modal_{{$articulo->id}}" tabindex="-1" role="dialog">   >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Borrado de articulo</h5>
                <button type="button" class="close" data-dismiss="modal" arial-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
                <div class="modal-body">
                <p>Vas a eliminar el articulo <span id="zona_de_nombre">{{$articulo->nombre}}</span>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                <form action="{{ route('articulos.destroy',$articulo->id)}}" method="post">
                @method ('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger">BORRAR</button>
                </form>
            </div>
        </div>
      </div>
    </div>
    </td>
    <!-- fin del modal ******************* -->
    <!-- Button trigger modal  2 ****** GRIS ********-->
    <td>            
    <button type="button" class="btn btn-secondary" id="btn_confirm2" data-toggle="modal" data-target="#delete_modal2_{{$articulo->id}}">
    Borrar con modal jquery
    </button>
    </td>

    <!-- ********** Button trigger EDITAR  ************* -->
    <td>
    <!-- formulario para la editar -->
    <div class="form-group">
    <a href="{{ route('articulos.edit',$articulo->id)}}" class="btn btn-warning" tabindex="-1" role="button" aria-disabled="true">Editar</a>
            
    </div>
    </td>
   


</tr>
    @endforeach
    </tbody>
    </h5>
    </table>
<!-- ************ jquery para confirmacion de borrado -->
<script>
var articulo;
var articulo_array;

// definimos el modal de eliminacion
$('.modal').modal({
  'dismisiable':false,'show':false,
});

<!-- cuando se pulsa un boton de borrar -->

$('.delete_link').on('click', function(e)){
  e.preventDefault();
  articulo =$(this).attr('id');
  articulo_array=JSON.parse(articulo);
  $('#zona_de_nombre').html(articulo_array["nombre"]);
  $('#delete_modal').modal('open');
});


$('#btn_confirm').on('click',function(e){
  e.preventDefault();
  var destino =($("#delete_form").attr('action'));
  var corte = destino.lastIndexOf('/')+1;
  var destinoBase = destino.substr(0, corte);
  destino= destinobase + articulo_array["id"];
  $("#delete_form").atrr('action', destino);
  $("#delete_form").submit();
});
</script>
<!-- **********************fin jquery *************** -->

<!-- aqui creamos un nuevo articulo -->
<br><br>

    <a class="btn btn-success" href="{{ route('articulos.create')}}" role="button">Crear nuevo</a>

    @endsection