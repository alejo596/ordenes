<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTimeInterface;

class HistorialOTs extends Model
{
	 protected $connection = 'ordenes_de_compras';
	protected $table = 'historial_ots';
	protected $fillable = [
		'oc',
		'id_estado_timeline',
		'firma_creador',
		'firma_encargado',
		'fecha_encargado',
		'firma_cc',
		'fecha_cc',
		'firma_sub',
		'fecha_sub',
		'firma_jcompras',
		'fecha_jcompras',
		'firma_comprador',
		'fecha_comprador',
		'firma_final',
		'fecha_final',
		'id_producto_compradores',
		'fecha_anular',
		'firma_quimico',
		'fecha_quimico'
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

	protected function serializeDate(DateTimeInterface $date){
    return $date->format('Y-m-d H:i:s');
}

}
