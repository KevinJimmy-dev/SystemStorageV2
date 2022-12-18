<?php

namespace App\Http\Services;

use App\Models\Control;
use App\Models\Product;
use App\Models\User;

class ProductService
{
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create($request)
    {
        $info = $request->all();

        $info['user_id'] = $this->user->id;

        $create = Product::create($info);

        $control = Control::create([
            'observation_control' => $request->observation,
            'user_id' => $this->user->id,
        ]);

        $control->products()->attach([
            1 => ['control_id' => $control->id, 'product_id' => $create->id]
        ]);
    }
}
