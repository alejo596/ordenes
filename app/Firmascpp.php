<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firmascpp extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'firmas_cpp';
	protected $fillable = [			
	
		'cpp',		
		'tipo',
		'usuario',
				

		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

}
