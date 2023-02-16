<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CppPrograma extends Model
{
  protected $connection = 'ordenes_de_compras';
	protected $table = 'cpp_programa';
	protected $fillable = [
		'cpp',
		'programa',
		'monto',
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
