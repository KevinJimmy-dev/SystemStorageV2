<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $dates = ['date'];

    public function users(){
        return $this->hasMany('App\Models\User');
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }
}
