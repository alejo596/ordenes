<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductosRecepcion extends Model
{
   protected $connection = 'bodega';
	protected $table = 'recepcion_producto';
	    protected $casts = [
		'id_recepcion',
		'id_programa_assoc',
		'cod_producto',
		'fecha_vencimiento',
		'cantidad_prod',
		'valor_unitario',
		'lote_producto',
		'id_bodega',
		'cantidad_quedan',
		'id_producto',
		
	];

		public $timestamps = false;
}