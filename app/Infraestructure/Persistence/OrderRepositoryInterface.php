<?php 
namespace App\Domain\Repositories;

use App\Domain\Entities\Order;

interface OrderRepositoryInterface
{
    public function save(Order $order);
    public function findById($id);
    public function getAll();
    public function updateOrderStatus($id, $status);
}
