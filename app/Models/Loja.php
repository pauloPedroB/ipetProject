<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loja extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded=[];

    public function User(){
        return $this->hasOne('App\Models\User');
    }


}
