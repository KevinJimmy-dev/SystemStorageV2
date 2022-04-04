<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function categories(){
        return $this->hasMany('App\Models\Categorie');
    }

    public function requests(){
        return $this->belongsToMany('App\Models\Request');
    }

    public function controls(){
        return $this->belongsToMany(Control::class);
    }
}
