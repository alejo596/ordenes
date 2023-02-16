<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdjuntosDocumentos extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'adjuntos_documentos';
	protected $fillable = [
		'nombre',
		'url',
		'tipo',
		'numero',
		'idproducto',
		'codigo'
		
		
	];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
