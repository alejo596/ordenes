<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class EtapasOts extends Model
{
     protected $connection = 'ordenes_de_compras';
	protected $table = 'etapas_ots';
	protected $fillable = [
		'oc',
		'id_historial_detalle',
		'etapa',
		'comprador',
		'fecha_inicio',
		'detalle_etapa',
		'fecha_termino',
		'proceso',
		'id_pro',
		'fecha_realizado'
		
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
	protected function serializeDate(DateTimeInterface $date){
    return $date->format('Y-m-d H:i:s');
}
}

