<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class CppPagoEnvios extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'cpp_pago_envio';
	protected $fillable = [
		'cpp',
		'id_factura',
		'id_recepcion',
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
protected function serializeDate(DateTimeInterface $date){
    return $date->format('Y-m-d H:i:s');
}
}
