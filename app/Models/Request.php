<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model{
    use HasFactory;

    protected $dates = ['date'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function products(){
        return $this->belongsToMany(Product::class);
    }

    public static function newRequest($request){
        $user = auth()->user();
        
        $quantity = $request->quantity;
        $requests = $request->request_value;
        $id = $request->id_product;
        $name = $request->name_product;

        if(empty($quantity)){
            return 0;
        } else{
            for($i = 0; $i < count($requests); $i++){
                if($requests[$i] <= 0){
                    return 1;
                } elseif($quantity[$i] < $requests[$i]){
                    return 2;
                } else{
                    $newQuantity = $quantity[$i] - $requests[$i];
                    
                    $update = Product::findOrFail($id[$i])->update(['quantity' => $newQuantity]);

                    if($update){
                        $requestModel = new Request();
    
                        $requestModel->quantity_request = $requests[$i];
                        $requestModel->user_id = $user->id;

                        $createRequest = $requestModel->save();
    
                        if($createRequest){
                            $requestModel->products()->attach([
                                1 => ['product_id' => $id[$i], 'request_id' => $requestModel->id]
                            ]);

                            return 3;
                        }
                    } else{
                        return 4;
                    }
                }
            }
        }
    }
}
