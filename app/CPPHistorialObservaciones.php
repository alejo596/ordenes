<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CPPHistorialObservaciones extends Model
{
	protected $connection = 'ordenes_de_compras';
	protected $table = 'cpp_historial_observaciones';
	protected $fillable = [		
		
		'cpp',
		'observacion',
		'usuario',
		'estado',

	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
