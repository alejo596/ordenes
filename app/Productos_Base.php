<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productos_Base extends Model
{
	protected $connection = 'ordenes_de_compras';
	protected $table = 'productos_base';
	    protected $fillable  = [
		'id',
		'codigo',
		'nombre',
		'unidad_medida',
		'precio',
		'codigo_grupo',
		'seccion',
		'estado',
		'usuario_ingresa',
		'cuenta_sigfe',
		'sub_item_sigfe',
		'nombre_sigfe',
		'familia_sigfe',
		'zgen'
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}


