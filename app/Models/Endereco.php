<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    public $timestamps = false;
    protected $guarded=[];

    use HasFactory;
   
   
    public function loja(){
        return $this->hasOne('App\Models\Loja');
    }
    public function usuario(){
        return $this->hasOne('App\Models\Usuario');
    }
}
