<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Product;


class StoreController extends Controller
{
    public function index(StoreRequest $request)
    {
        $data = $request->validated();
        $product = Product::create($data);

        return $product;

    }
}
