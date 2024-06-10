<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class entrada extends Model
{
    use HasFactory;

    protected $table = "entrada";



    // protected $fillable = ['nombre_articulo', 'cantidad'];
    // public function articulo()
    // {
    //     return $this->belongsTo(articulo::class);
    // }



    
}
