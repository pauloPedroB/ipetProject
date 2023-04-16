<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productsLoja extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $guarded=[];

    public function loja(){
        return $this->belongsTo('App\Models\Loja');
    }
    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
