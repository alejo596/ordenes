<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ViaticosCpp extends Model
{
   protected $connection = 'ordenes_de_compras';
    protected $table = 'viatico_cpp';
    protected $fillable = [
        
        'cpp',
        'viatico',
       
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
