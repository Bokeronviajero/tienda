<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $articulos= Articulo::all();
        /* return view ('articulos.listar-todos')->with([
            'articulos'=>$articulos
            ]);
        */
            return view ('articulos.listar-todos',compact('articulos'));
                
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articulos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //aqui le decimos que haga la validacion
        $request->validate(
            ['nombre'=> 'required | max:10',
            'isbn'=> 'required | max:10 | unique:articulos,isbn']
        );
        
        //aqui guardamos en la base de datos
        //atencion el nombre de los campos del formulario deben de coincidir
        //con el nombre de los campos en el modelo
        $articulo=Articulo::create($request->all());
        
        //aqui comprobamos que la imagen del articulo existe
        if ($request->file('photos') != null) {
           
            //aqui guardamos la imagen en la tabla files
            $photos=$request->file('photos');
            //$photo_name=$photo_name.str_ramdom(5).time();
            
            foreach ($photos as $photo){
                // Automatically generate a unique ID for filename...
                //$path = Storage::putFile('photos', new File('/public'));
                
                $path=$photo->store('public');
                //aqui tenemos que quitar el public/ de la ruta
                $path= str_replace('public/','',$path);
                //aqui obtenemos el nombre original de la foto
                $photo_name = $photo->getClientOriginalName();
                Photo:: create([
                'articulo_id'=>$articulo->id,
                'name'=>$photo_name,
                'path'=>$path,
                ]);
            }
        }

        //aqui despues de grabar volvemos a vista de la lista de articulos
        $articulos= Articulo::all();
        return redirect('/articulos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function show(int $articuloId)
    {
        
        $articulo=Articulo::find($articuloId);
        
        $photos=($articulo->photos) ?? null;
        
        return view('articulos.show',
            [
                'articulo'=>$articulo,
                'photos'=>$photos
            ]
        );
        /* return json_encode($articulo); */

    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function edit(int $articuloId)
    {
        //dd($articuloId);
        $articulo=Articulo::find($articuloId);
        //return view('articulos.edit',compact('articulo'));
        $photos=($articulo->photos);
        //dd($photos);
        return view('articulos.edit',
        [
            'articulo'=>$articulo,
            'photos'=>$photos
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Articulo $articulo)
    {
        //aqui empezamos con la validacion
        //dd($request->all());
        
        $requestData=$request->all();
        
         //dd($request->all());

        Articulo::find($articulo->id)->update($requestData);
        //$cambio->nombre =$request->nombre;
        //$cambio->save(); 

        //aqui comprobamos que la imagen del articulo existe
        if ($request->file('photos') != null) {
           
            //aqui guardamos la imagen en la tabla files
            $photos=$request->file('photos');
            //$photo_name=$photo_name.str_ramdom(5).time();
            
            foreach ($photos as $photo){
                // Automatically generate a unique ID for filename...
                //$path = Storage::putFile('photos', new File('/public'));
                
                $path=$photo->store('public');
                //aqui tenemos que quitar el public/ de la ruta
                $path= str_replace('public/','',$path);
                //aqui obtenemos el nombre original de la foto
                $photo_name = $photo->getClientOriginalName();
                Photo:: create([
                'articulo_id'=>$articulo->id,
                'name'=>$photo_name,
                'path'=>$path,
                ]);
            }
        }else{
            //dd($request);
        }
        //aqui despues de grabar volvemos a vista de la lista de articulos
        $articulos= Articulo::all();
        return view ('articulos.listar-todos')->with(['articulos'=>$articulos]); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Articulo  $articulo
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //dd($request->all());
        $eliminar= Articulo::find($id);
        $eliminar->delete();
        return back(); 
        
   
    }
/* 
     public function eliminar(int $id)
    {
        $eliminar= Articulo::find($id);
        $eliminar->delete();
        return back(); 
    }  */

    public function eliminarPhoto(int $id)
    {
        $eliminar_photo= Photo::find($id);
        $eliminar_photo->delete();
        return back(); 
        
    }
}
