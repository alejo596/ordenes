<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
	protected $connection = 'ordenes_de_compras';
	protected $table = 'compra';
	protected $fillable = [
		'compra_id',
		'compra_numero',
		'compra_amio',
		'compra_nombre_usuario_rut',
		'compra_cc',
		'compra_sub_direccion',
		'compra_jefatura_sub_rut',
		'compra_jefatura_sub_aprueba_fecha',
		'compra_encargado_cc_rut',
		'compra_encargado_cc_aprueba_fecha',
		'compra_fecha_guardada',
		'compra_rut_guardada',
		'compra_fecha_enviar',
		'compra_rut_enviar',
		'compra_asignada',
		'compra_estado',
		'compra_correo',
		'compra_proyecto',
		'compra_telefono',
		'compra_convenio',
		'compra_anulada_por',
		'compra_motivo_anulacion',
		'compra_fecha_anulacion',
		'sigfe_presupuesto',
		'id_observacion',
		'id_licitacion',
		'id_actividad'
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}



