<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refrendacionporcc extends Model
{
 protected $connection = 'ordenes_de_compras';
	protected $table = 'refrendacion_cc';
	protected $fillable = [		
		'cc',		
		'monto',		
		'year',
		'sigfe'
		
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}