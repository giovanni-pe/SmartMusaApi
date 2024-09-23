<?php
namespace App\Domain\Services;

use App\Domain\Repositories\OrderRepositoryInterface;
use App\Domain\Entities\Customer;
use App\Domain\Entities\Order;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder(Customer $customer, $product, $quantity, $totalAmount)
    {
        $order = new Order([
            'customer_id' => $customer->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        $this->orderRepository->save($order);
        return $order;
    }
}
