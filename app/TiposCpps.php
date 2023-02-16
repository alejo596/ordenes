<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposCpps extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'tipo_cpp';
	protected $fillable = [
		
		'nombre'
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
