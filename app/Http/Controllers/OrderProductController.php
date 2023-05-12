<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderUser;

class OrderProductController extends Controller
{
    public function addData(Request $request)
    {
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $region = $request->input('region');
        $city = $request->input('city');
        $postOffice = $request->input('postOffice');
        $paymentMethod = $request->input('paymentMethod');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $total_price = $request->input('total_price');
        $status = $request->input('status');
        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity');
        $price = $request->input('price');
        $name = $request->input('name');
        $image = $request->input('image');

        $orderUser = OrderUser::create([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'region' => $region,
            'city' => $city,
            'postOffice' => $postOffice,
            'paymentMethod' => $paymentMethod,
            'email' => $email,
            'phone' => $phone
        ]);

        $order = Order::create([
            'order_user_id' => $orderUser->id,
            'total_price' => $total_price,
            'status' => $status
        ]);

        $orderProduct = OrderProduct::create([
            'order_id' => $order->id,
            'product_id' => $product_id,
            'quantity' => $quantity,
            'price' => $price,
            'name' => $name,
            'image' => $image
        ]);

        return response()->json(['message' => 'Данные успешно добавлены']);
    }
}
