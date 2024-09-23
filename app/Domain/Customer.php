<?php 

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'email', 'phone'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public static function getAllCustomers()
    {
        return self::all();
    }

 
    public static function findCustomerById($id)
    {
        return self::find($id);
    }

    public static function updateCustomer($id, $data)
    {
        $customer = self::find($id);
        if ($customer) {
            $customer->update($data);
        }
        return $customer;
    }
}
