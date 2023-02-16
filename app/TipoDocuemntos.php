<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocuemntos extends Model
{
   protected $connection = 'bodega';
    protected $table = 'tipo_documento';
	public $timestamps = false;
}
