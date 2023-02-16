<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogRefrendacion extends Model
{
    protected $connection = 'ordenes_de_compras';
    protected $table = 'log_refrendacion';
    protected $fillable = [
     'monto',
     'refrendacion',
     'cc',
     'usuario',
     'id_antiguo'
     

     ];
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
