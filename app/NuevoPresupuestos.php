<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NuevoPresupuestos extends Model
{
    protected $connection = 'presupuesto';
	protected $table = 'presupuesto';
	protected $fillable = [
		
		'cc',
		'monto',
		'amio',
		'cr',
		'usuario',
		'ip',
		'sigfe'	
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
