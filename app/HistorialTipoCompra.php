<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialTipoCompra extends Model
{
	protected $connection = 'ordenes_de_compras';
	protected $table = 'historial_tipo_compra';
	protected $fillable = [
		
		'etapa_nombre',
		'estado',
		'tipo_compra',
		'id_ot',
		'id_pro',
		'lictacion_numero',
		'licitacion_fecha',
		'licitacion_nombre',
		'licitacion_estado',
		'licitacion_cierre',
		'id_historial_detalle',
		'observacion',
		'fecha_inicio'
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}

