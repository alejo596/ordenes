<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Compromisos extends Model
{
	protected $connection = 'ordenes_de_compras';
	protected $table = 'compromisos';
	protected $fillable = [		
		'numero',
		'`year`',
		'oc',
		'estado',
		'id_observacion',
		'total_neto',
		'iva',
		'total',
		'descuento',
		'despacho',
		'impuesto',
		'tipo',
		'id_convenios',
		'id_proveedor',
		'id_migracion_cpp',
		'tipo_cpp',
		'usuario',
		'id_factura',
		'id_comprador',
		'ajustes',
		'id_licitacion',
		'id_f_quimico',
		'sigfe_pago',
		'ocportal'
		

	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
	protected function serializeDate(DateTimeInterface $date)
{
    return $date->format('Y-m-d H:i:s');
}
}
