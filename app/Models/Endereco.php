<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    public $timestamps = false;
    protected $guarded=[];

    use HasFactory;
    public function User(){
        return $this->hasMany('App\Models\User');
    }
    public function Endereco(){
        return $this->hasMany('App\Models\Product');
    }
}
