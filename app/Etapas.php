<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Etapas extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'etapas';
	protected $fillable = [
		'nombre',
		'total'
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
