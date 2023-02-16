<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObservacionRechazos extends Model
{
   protected $connection = 'ordenes_de_compras';
	protected $table = 'observacion_rechazo';
	protected $fillable = [
		
		'observacion',
		'cpp',
	
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
