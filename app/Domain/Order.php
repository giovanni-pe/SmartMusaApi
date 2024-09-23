<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_id', 'product_id', 'quantity', 'total_amount', 'status'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public static function getAllOrders()
    {
        return self::with('customer', 'product')->get();
    }

    public static function findOrderById($id)
    {
        return self::with('customer', 'product', 'payment')->find($id);
    }

    public static function updateOrderStatus($id, $status)
    {
        $order = self::find($id);
        if ($order) {
            $order->status = $status;
            $order->save();
        }
        return $order;
    }
}
