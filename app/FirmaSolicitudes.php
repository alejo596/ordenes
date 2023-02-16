<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirmaSolicitudes extends Model
{
   protected $connection = 'ordenes_de_compras';
	protected $table = 'firmas_solicitudes';
	protected $fillable = [			
	
		'id_solicitud',		
		'usuario',
		'estado',
				

		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

}

