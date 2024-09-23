<?php 

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['order_id', 'amount', 'transaction_id', 'status'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
