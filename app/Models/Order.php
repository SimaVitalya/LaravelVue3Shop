<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = false;


    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class,'order_id', 'id');
    }

    public function orderUser()
    {
        return $this->hasOne(OrderUser::class, 'id', 'order_user_id');
    }

}
