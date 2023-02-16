<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagados extends Model
{
     protected $connection = 'ordenes_de_compras';
	protected $table = 'pagado';
	protected $fillable = [
		
		'id_compromiso',
		'year',
		'monto',
		'ot',
		'estado',
		'cc',
		'sigfe'
			
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
