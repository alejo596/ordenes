<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdjuntosOts extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'adjuntos_ots';
	protected $fillable = [
		'nombre',
		'url',
		'oc',
		'id_producto'

		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
