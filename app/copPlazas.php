<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class copPlazas extends Model
{
    //
    protected $table = 'cop_plazas';
    public $timestamps = false;
    protected $fillable = ['id', 'sede', 'dependencia','rotulo','modalidad'];
}
