<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirmasOrdenes extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'aprobar_nivel1';
		protected $fillable = [
		'rut_aprobar','nombre_aprobar','cc_asociado_aprobar','aprobado','fecha_de_aprobado_o_rechazado','id_ot'
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

}
