<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConveniosProgramas extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'convenios_programas';
	protected $fillable = [
		'convenio_id',
		'monto',
		'destino',
		
		
			
		
	];
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
