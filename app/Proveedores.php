<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedores extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'proveedores';
	protected $fillable = [
		'id',
		'run',
		'estado',
		'nombre',
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
