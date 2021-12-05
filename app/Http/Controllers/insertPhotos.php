?<?php
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
?>
