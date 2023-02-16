<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CppLiberar extends Model
{


    protected $connection = 'ordenes_de_compras';
    protected $table = 'cpp_liberar';
    protected $fillable = [
        'cpp',
        'usuario',
        'motivo',
        
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

}
