<!-- Formulario que integramos dentro de las vistas create, edit, y show -->
<br><br>
@if($FormType != 'create')
<div class="form-group row">
    <label for="id" class="col-sm-2 col-form-label">id del articulo</label>
    <div class="col-sm-4">
    <input class="form-control" type="text" name="id" id="id" 
    value="@isset($articulo) {{$articulo->id}} @endisset" disabled>
    </div>
</div>   
@endif

<div class="form-group row">
<label for="nombre" class="col-sm-2 col-form-label">Nombre del articulo</label>
    <div class="col-sm-4">
    <input class="form-control" type="text" name="nombre" id="nombre" 
    value="@isset($articulo) {{$articulo->nombre}} @endisset" @if($FormType == 'show')disabled @endif>
    </div>
</div>

<div class="form-group row">
<label for="isbn" class="col-sm-2 col-form-label">ISBN del articulo</label>
    <div class="col-sm-4">
    <input class="form-control" type="text" name="isbn" id="isbn" 
    value="@isset($articulo){{$articulo->isbn}}@endisset" @if($FormType == 'show')disabled @endif>
    </div>
</div>
@if($FormType != 'show' && $FormType !='edit')
<div class="form-group row">
<label for="nombre_photo" class="col-sm-2 col-form-label">Nombre de Foto</label>
    <div class="col-sm-4">
    <input type="text" class="form-control" name="nombre_photo" id="nombre_photo" 
    value="@isset($articulo){{$articulo->isbn}}@endisset" @if($FormType == 'show')disabled @endif>
    </div>
</div>
@endif
<br>
@if($FormType != 'show' && $FormType !='edit')
<div class="form-group row">
    <label for="photo" class="col-sm-2 col-form-label">Fotos del articulo</label>
    <div class="col-sm-10">
    <input type="file" class="form-control-file" name="photos[]" multiple>
    </div>
</div>
@endif

{{-- aqui mostramos las fotos del articulo --}}
@if($FormType != 'create')
@if( $FormType != 'show')
<div class="form-group">
    <label for="nombre_foto" class="col-sm-2 col-form-label">Fotos del articulo</label>
    @foreach ($photos as $photo)
        <div class="row">
            <div class="class col-sm-2">
            @if (isset($articulo->photos()->first()->path) != null)
            <td><img src="{{$articulo->photos()->first()->path}}" width="80" height="" alt=""></td>
            @else
            <td>
            <img src="{{'default_photo.jpg'}}" width="80" height="" alt="">
            </td>
            @endif
            </div>
            <div class="class col-sm-4">
                <input class="form-control" type="text" name="nombre_foto" id="nombre_foto" 
                value="@isset($photo) {{$photo->name}} @endisset"
                @if ($FormType == 'show') disabled @endif
                @if ($FormType == 'edit') disabled @endif>
            </div>      
            <div class="class col-sm-4">
                <!-- Button trigger modal  1 ****** ROJO ********-->
                <td>            
                <button type="button" class="btn btn-danger" id="btn_confirm" data-toggle="modal" data-target="#delete_modal_{{$photo->id}}">
                Borrar con modal
                </button>
                </td>
                <td>
            </div>    
        <!-- formulario para la eliminacion -->
        <form id="delete_form" action="{{ route('photos.destroy',$photo->id)}}" method="post">
        @method ('DELETE')
        @csrf
        </form>
            <!-- Modal ROJO ******* MODAL PARA ELIMINACION **************************-->
            <div class="modal fade" id="delete_modal_{{$photo->id}}" tabindex="-1" role="dialog">   >
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Borrado de foto prueba</h5>
                        <button type="button" class="close" data-dismiss="modal" arial-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Vas a eliminar la foto <span id="zona_de_nombre">{{$photo->name}}</span>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                        <form action="{{ route('photos.eliminarPhoto',$photo->id)}}" method="post">
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
        </div>
    @endforeach

    <br>
@endif
@endif
<!--boton añadir foto ********************-->
@if($FormType != 'show' && $FormType !='create')
<div class="form-group row">
    <label for="photo" class="col-sm-2 col-form-label">Añadir Fotos</label>
    <div class="col-sm-10">
    <input type="file" class="form-control-file" name="photos[]" multiple>
    </div>
</div>
@endif

