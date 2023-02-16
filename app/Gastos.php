<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
     protected $connection = 'presupuesto';
	protected $table = 'gastos';
	protected $fillable = [
		'id',
'id_producto',
'cr',
'cc',
'monto',
'sigfe',
'sub_sigfe',
'familia',
'mes',
'`year`',
'ot',
'numero_ot',
'year_ot',
'fecha_ot',
'cpp',
'id_observacion',
'estado',
'motivo',
'fecha_motivo',
'id_factura',
'id_refrendacion',
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
