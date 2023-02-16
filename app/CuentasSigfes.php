<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class CuentasSigfes extends Model
{
	protected $connection = 'ordenes_de_compras';
	protected $table = 'cuentas_sigfe';
	protected $fillable = [
		'nombre',
		'sigfe_id',
		'sub_item',
		'sigfe_obsoleta'

	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
	protected function serializeDate(DateTimeInterface $date){
		return $date->format('Y-m-d H:i:s');
	}
}
