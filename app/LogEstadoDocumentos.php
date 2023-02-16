<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogEstadoDocumentos extends Model
{
     protected $connection = 'facturacion';
	protected $table = 'log_estados_documentos';
		protected $fillable = [
		'id_documento',
		'id_docto_estado',
		'responsable',
		'dias',
		'ip',
		'devolucion'

	];
	const CREATED_AT = 'created_at';
	const UPDATED_AT = null;

	
}
