<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Observacion extends Model
{
      protected $connection = 'ordenes_de_compras';
	protected $table = 'observacion_ot';
	protected $fillable = [
		'ot',
		'observacion',
		'usuario'
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
