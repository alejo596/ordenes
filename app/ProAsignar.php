<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class ProAsignar extends Model
{
	protected $connection = 'ordenes_de_compras';
	protected $table = 'pro_asignar';
	protected $fillable = [
		'pro_id',
		'ot',
		'usuario'
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';



protected function serializeDate(DateTimeInterface $date)
{
    return $date->format('Y-m-d H:i:s');
}
}

