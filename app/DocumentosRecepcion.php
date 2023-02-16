<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentosRecepcion extends Model
{
     protected $connection = 'facturacion';
	protected $table = 'documento_has_recepcion';
		protected $fillable = [
		'id_documento',
		'id_recepcion_bodega',
		'created_at',
		'id_mini_recepcion',
		'responsable'
	];

	public $timestamps = false;
	
}
