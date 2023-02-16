<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adjuntos extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'adjuntos';
	protected $fillable = [
		'adj_id_solicitud',
		'adj_adjuntado',
		'adj_nombre',
		'adj_fecha',
		'adj_producto_id'
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
