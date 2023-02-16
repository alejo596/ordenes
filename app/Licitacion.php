<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Licitacion extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'licitacion';
	protected $fillable = [			
	
		'nombre',		
		'fecha',
		'cpp',
		'oc',
		'fecha_termino',
		'codigo'		

		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
