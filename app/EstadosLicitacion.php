<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadosLicitacion extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'estado_licitacion';
	protected $fillable = [
		'nombre',
		'codigo'
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
