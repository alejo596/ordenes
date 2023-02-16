<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompradorProductos extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'comprador_productos';
	protected $fillable = [
		'oc',
		'id_producto',
		'comprador',
		'estado',
		'id_historial_detalle'
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
