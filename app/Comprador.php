<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comprador extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'funcionarios_compra';
	protected $fillable = [
		'id',
		'per_id',
		'per_nombre',
		'per_fuera_ssa',
		'per_detalle_dep',
		'per_correo',
		'sexo'

		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
