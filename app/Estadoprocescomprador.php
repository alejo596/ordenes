<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estadoprocescomprador extends Model
{
   protected $connection = 'ordenes_de_compras';
	protected $table = 'estado_proceso_compra';
	protected $fillable = [
		'nombre',
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
