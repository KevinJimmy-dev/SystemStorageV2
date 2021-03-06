<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function requests(){
        return $this->belongsToMany('App\Models\Request');
    }

    public function controls(){
        return $this->belongsToMany(Control::class);
    }

    public static function newProduct($request, $user){
        $info = $request->all();

            $create = Product::create($info);

            if($create){
                $control = new Control();

                $control->observation_control = $request->observation;
                $control->user_id = $user->id;

                $createControl = $control->save();

                if($createControl){
                    $control->products()->attach([
                        1 => ['control_id' => $control->id, 'product_id' => $create->id]
                    ]);

                    return true;
                }
            } else{
                return false;
            }
    }
}
