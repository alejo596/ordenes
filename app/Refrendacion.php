<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refrendacion extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'refrendacion';
	protected $fillable = [
		'id',
		'id_compromiso',
		'estado',
		'envio',
		'fecha_envio',
		'encargado',
		'fecha_encargado',
		'jefatura',
		'monto',
		'fecha_jefatura',
		'year',
		'sigfe'
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
