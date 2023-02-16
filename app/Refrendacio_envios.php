<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refrendacio_envios extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'detalle_refrendacion';
	protected $fillable = [
		'id_refrendacion',		
		'monto',
		'cc',
		'sigfe',	
		'year',
		'id_producto'	
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
