<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class Productos extends Model
{
	protected $connection = 'ordenes_de_compras';
	protected $table = 'producto_compra';
	protected $fillable = [
		'pro_id',
		'pro_id_oc',
		'pro_nombre',
		'pro_cantidad',
		'pro_descripcion',
		'pro_precio',
		'pro_id_aba',
		'pro_ordenados_por_numero',
		'pro_comprador',
		'pro_id_detalle_compra',
		'pro_oc_portal_id',
		'pro_id_cpp',
		'pro_estado_refrendacion',
		'pro_cuenta_sigfe',
		'pro_total',
		'pro_uindad_medida',
		'pro_nombre_sigfe',
		'pro_nombre_producto',
		'pro_sub_item_sigfe',
		'pro_estado_producto',
		'pro_estado_producto_anterior',
		'pro_costo_unitario_incluye_todo',
		'pro_justificacion',
		'pro_cc',
		'pro_oc_portal_individual',
		'pro_amio',
		'pro_convenio',
		'pro_cantidad_solicitud',
		'pro_precio_unitario',
		'pro_cantidad_unitario',
		'pro_costo_unitario_producto_sin_ajuste',
		'pro_costo_unitario_ajuste',
		'pro_factura_unitaria',
		'pro_diferencia_adicionada',
		'pro_ID_ZGEN',
		'id_proceso',
		'sigfe_item',
		'pro_observacion'
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';



protected function serializeDate(DateTimeInterface $date)
{
    return $date->format('Y-m-d H:i:s');
}
}


