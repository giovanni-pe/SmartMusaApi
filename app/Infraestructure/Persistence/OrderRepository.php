<?php 
namespace App\Infrastructure\Persistence;

use App\Domain\Entities\Order;
use App\Domain\Repositories\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function save(Order $order)
    {
        $order->save();
    }

    public function findById($id)
    {
        return Order::find($id);
    }
     public function getAll()
     {
         return Order::with('customer', 'product', 'payment')->get();
     }
 
    
     public function updateOrderStatus($id, $status)
     {
         $order = $this->findById($id);
         if ($order) {
             $order->status = $status;
             $order->save();
         }
         return $order;
     }
}
