<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CierreProcesos extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'cierre_proceso';
	  protected $fillable = [
                      'id',
                     'firma',
                     'estado'
                     ];

	const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';
}
