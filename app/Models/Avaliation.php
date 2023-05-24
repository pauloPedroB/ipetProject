<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliation extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function Loja(){
        return $this->hasOne('App\Models\Loja');
    }
    public function Usuario(){
        return $this->hasOne('App\Models\Usuario');
    }

}
