<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecepcionBodegas extends Model
{

	protected $connection = 'bodega';
	protected $table = 'recepcion_bodega';
	protected $fillable = [
		'id_recepcion',
		'num_recepcion',
		'year_recepcion',
		'fecha_ingreso',
		'fecha_recepcion',
		'num_docto',
		'tipo_docto',
		'estado_docto',
		'proveedor',
		'programa',
		'bodeguero',
		'ip_recepcion',
		'n_lic',
		'obs',
		'id_cpp',
		'id_factura',
		'motivo_no_envio_correo',
		'esta_pagada'	
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}



