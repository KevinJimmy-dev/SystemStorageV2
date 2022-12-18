<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $with = ['users'];

    protected $guarded = [];

    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function requests()
    {
        return $this->belongsToMany(\App\Models\Request::class, 'request_products');
    }

    public function controls()
    {
        return $this->belongsToMany(Control::class, 'control_products');
    }
}
