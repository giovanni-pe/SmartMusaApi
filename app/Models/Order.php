<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    // Campos que pueden ser llenados de manera masiva
    protected $fillable = [
        'customer_id', 
        'product_id', 
        'quantity', 
        'total_amount', 
        'status', 
        'address1', 
        'address2', 
        'city', 
        'state', 
        'zip', 
        'country', 
        'delivery_date'
    ];

    // Relación con el modelo Customer (Comprador)
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relación con el modelo Product (Producto)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relación con el modelo Payment (Pago)
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
