<?php

namespace App\Models;
/* necesitamos importar el modelo con el que se relaciona
 para pode usar la clave foranea que los une */
use App\Photo;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    protected $fillable = ['nombre','isbn'];

    public function photos()
    {
        return $this->hasMany('App\Models\Photo','articulo_id','id');
    }

}
