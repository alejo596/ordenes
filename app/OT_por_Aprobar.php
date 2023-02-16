<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OT_por_Aprobar extends Model
{
    protected $connection = 'ordenes_de_compras';
	protected $table = 'compra';
}
