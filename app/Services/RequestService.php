<?php

namespace  App\Services;

use App\Models\Product;
use App\Models\Request;
use App\Models\RequestProduct;

class RequestService
{

    public function newRequest($request)
    {
        $user = auth()->user();

        if (count($request->quantity) == 0) {
            return 0;
        }

        for ($i = 0; $i < count($request->request_value); $i++) {
            if ($request->request_value[$i] <= 0) {
                return 1;
            }

            if ($request->quantity[$i] < $request->request_value[$i]) {
                return 2;

            } else {
                $product = Product::find($request->id_product[$i]);

                if (is_null($product)) {
                    return 4;
                }

                $product->update(['quantity' => $request->quantity[$i] - $request->request_value[$i]]);


                $newRequest = Request::create([
                    'quantity_request' => $request->request_value[$i],
                    'user_id' => $user->id
                ]);

                RequestProduct::create([
                    'request_id' => $newRequest->id,
                    'product_id' => $product->id
                ]);

                return 3;
            }
        }
    }
}
