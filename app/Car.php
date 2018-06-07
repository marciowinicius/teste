<?php

namespace FederalSt;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['user_id', 'placa', 'renavam', 'modelo', 'marca', 'ano'];
}
