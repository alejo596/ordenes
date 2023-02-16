<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Centros extends Model
{
    protected $connection = 'presupuesto';
    protected $table = 'centrosdecostos';
}
