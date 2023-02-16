<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convenioscpp extends Model
{
   protected $connection = 'ordenes_de_compras';
	protected $table = 'convenios';
	protected $fillable = [
		'nombre',
		'fecha_i',
		'fecha_t',
		'id_cpp',
		'monto',
		'nuevo',
		'estado',
		'programa',
		'usuario',
		'cc',
		'proveedor',
		'id_convenio'
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
