<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $guarded=[];
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    public function Endereco(){
        return $this->belongsTo('App\Models\Endereco');
    }
    public function productsLoja(){
        return $this->hasMany('App\Models\productsLoja');
    }
}
