<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConveniosProductos extends Model
{
  protected $connection = 'ordenes_de_compras';
	protected $table = 'convenio_productos';
	protected $fillable = [
		'convenio',
		'producto',
		
		
	];
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
