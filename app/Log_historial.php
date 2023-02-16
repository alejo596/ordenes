<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log_historial extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'log_historial';
	protected $fillable = [			
	
		'proceso',		
		'id_producto',
		'estado',
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
