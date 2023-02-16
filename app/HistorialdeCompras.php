<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;
class HistorialdeCompras extends Model
{
     protected $connection = 'ordenes_de_compras';
	protected $table = 'historia_de_compra';
	protected $fillable = [
		
		 'id_compra',
		 'estado',
		 'actividad'
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

	protected function serializeDate(DateTimeInterface $date){
    return $date->format('Y-m-d H:i:s');
}
}
