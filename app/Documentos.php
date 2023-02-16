<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;

class Documentos extends Model
{
	protected $connection = 'facturacion';
	protected $table = 'documentos';

	protected $fillable = [
		'id',
		'numero',
		'monto',
		'fecha_factura',
		'fecha_recepcion',
		'fecha_pago',
		'proveedor_rut',
		'docto_tipo_id',
		'docto_estado_id',
		'docto_sistema_id',
		'link',
		'ocportal',
		'n_sigfe_devengo',
		'n_sigfe_cpp',
		'n_sigfe_pago',
		'factoring',
		'mostrarEnBandeja',
		'n_sigfe_compensatorio',
		'tgr',
		'r2',
		'chk_oc',
		'devolucion',
		'extra_presupuestaria',
		'nuevocpp'
	];

	public $timestamps = false;



}
