<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CppConformidad extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'cpp_conformidad';
	protected $fillable = [
		'cpp',
		'usuario',
		'estado',
		'id_conformidad'
		
			
		
	];
	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
