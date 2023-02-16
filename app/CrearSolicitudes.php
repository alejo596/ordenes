<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrearSolicitudes extends Model
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
		
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

}
