<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderUser;
use Illuminate\Http\Request;

class OrderProductController extends Controller
{
    public function addData(OrderRequest $request)
    {
        $validatedData = $request->validated();

        $orderUser = OrderUser::create([
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'region' => $validatedData['region'],
            'city' => $validatedData['city'],
            'postOffice' => $validatedData['postOffice'],
            'paymentMethod' => $validatedData['paymentMethod'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone']
        ]);

        $order = Order::create([
            'order_user_id' => $orderUser->id,
            'total_price' => $validatedData['total_price'],
        ]);

        foreach ($validatedData['cart'] as $item) {
            $orderProduct = OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'name' => $item['name'],
                'image' => $item['image'],
                'price' => $item['price'],
                'quantity' => $item['quantity']
            ]);
        }

        return response()->json(['message' => 'Данные успешно добавлены']);
    }

    public function getOrder()
    {

        $orders = Order::with('orderUser', 'orderProducts')->get();

        return response()->json($orders);
    }

}
