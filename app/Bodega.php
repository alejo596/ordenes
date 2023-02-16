<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bodega extends Model
{
      protected $connection = 'bodega';
	protected $table = 'bodega';
	protected $fillable = [
		'id',
		'tipo_bodega',
		'cod_producto',
		'stock_producto',
		'id_programa_assoc',
		'lote_producto',
		'unidad_medida',
	
			
		
	];
		public $timestamps = false;
}
