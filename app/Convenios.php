<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convenios extends Model
{
	protected $connection = 'convenios';
	protected $table = 'contratos';
	protected $fillable = [
		'cont_id',
		'cont_estado',
		'cont_rut',
		'cont_nombre_empresa',
		'cont_nombre',
		'cont_n_licitacion',
		'cont_monto_inicial',
		'cont_monto_actual',
		'cont_fecha_inicio',
		'cont_fecha_termino',
		'cont_u_responsable',
		'cont_p_responsable',
		'cont_cc',
		'cont_rut_quien_crea_convenio',
		'cont_nombre_abreviado',
		'idcpp',
		'year'
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
