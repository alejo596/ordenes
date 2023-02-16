<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Solicitudes extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'solicitudes';
	protected $fillable = [
		
		'tipo',
		'estado',
		'usuario',
		'year',
		'cc',
		'numero',
		'id_doc',
		'observacion',
		'activo',
		'anticipo',
		'idproveedor'
		
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
	protected function serializeDate(DateTimeInterface $date)
{
    return $date->format('Y-m-d H:i:s');
}
}
