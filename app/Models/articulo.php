<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class articulo extends Model
{
    use HasFactory;

    protected $table = "articulo";

    // protected $fillable = ['nombre_articulo','stock'];

    //   public function entrada(){
    //     return $this -> hasMany(entrada::class);
    // }


    //  protected $fillable = ['stock']; // Especifica los campos que se pueden asignar masivamente

    
}
