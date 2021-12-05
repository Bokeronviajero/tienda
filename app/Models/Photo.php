<?php

namespace App\Models;
/* necesitamos importar el modelo con el que se relaciona
 para pode usar la clave foranea que los une */
use App\Articulo;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
   
    protected $fillable = ['articulo_id','path','name'];

    public function articulo()
    {
        //aqui establecemos relacion con tabla articulos
        return $this->belongsTo('App\Models\Articulo');
    }
    
}
