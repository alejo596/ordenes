<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Procesos extends Model
{
	protected $connection = 'ordenes_de_compras';
	protected $table = 'procesos';
	protected $fillable = [			
	
		'estado',		
		'id_comprador',
		'etapa',
		'id_licitacion',
		'year',
		'observacion'

		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
protected function serializeDate(DateTimeInterface $date){
    return $date->format('Y-m-d H:i:s');
}


}

