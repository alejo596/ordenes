<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conformidad extends Model
{
    protected $connection = 'bodega';
	protected $table = 'certificado_conformidad';
	protected $fillable = [
		'cert_id',
		'cert_num',
		'cert_year',
		'fecha_ingreso',
		'cert_anexo',
		'cert_prod_cod',
		'cert_id_cpp',
		'cert_id_fact',
		'cert_sistema_rut',
		'cert_sistema_depto',
		'cert_sistema_ip',
		'cert_sistema_fecha',
			
		
	];
		public $timestamps = false;
}
