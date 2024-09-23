<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'stock'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    // Decrease stock when an order is placed
    public function decreaseStock($quantity)
    {
        if ($this->stock >= $quantity) {
            $this->stock -= $quantity;
            $this->save();
            return true;
        }
        return false; // Not enough stock
    }

    // Increase stock when an order is canceled
    public function increaseStock($quantity)
    {
        $this->stock += $quantity;
        $this->save();
    }

    // Fetch product by ID
    public static function findProductById($id)
    {
        return self::find($id);
    }

    // Get all products
    public static function getAllProducts()
    {
        return self::all();
    }
}
