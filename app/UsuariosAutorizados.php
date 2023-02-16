<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuariosAutorizados extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'usuario_autorizados_cierre';
	  protected $fillable = [
                      'id',
                     'usuario',
                     'id_cierre_proceso',
                     'estado'
                     ];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
