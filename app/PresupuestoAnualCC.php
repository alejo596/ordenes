<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PresupuestoAnualCC extends Model
{
    protected $connection = 'mysql2';
	protected $table = 'presupuesto';
	public $timestamps = false;
}
