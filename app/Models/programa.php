<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class programa extends Model
{
    use SoftDeletes;
    use HasFactory;

    // protected $connection = "conexion";

    protected $table = "programa";

    // protected $primaryKey = 'codigo';

    // protected $keyType = 'string';

    // public $incrementing = false;

    // // created_at, updated_at
    // public $timestamps = false;
}
