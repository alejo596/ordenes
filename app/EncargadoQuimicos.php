<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EncargadoQuimicos extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'encargado_quimicos';
	protected $fillable = [			
	
		'usuario',		
		'estado',
				

		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
