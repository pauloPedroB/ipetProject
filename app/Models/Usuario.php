<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $guarded=[];

    public function User(){
        return $this->hasOne('App\Models\User');
    }
    public function endereco(){
        return $this->hasOne('App\Models\Endereco');
    }
    public function Avaliation(){
        return $this->hasMany('App\Models\Avaliation');
    }
}
