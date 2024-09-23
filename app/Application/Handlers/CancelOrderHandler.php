<?php 
namespace App\Application\Handlers;

use App\Application\Commands\CancelOrderCommand;
use App\Domain\Repositories\OrderRepositoryInterface;
use App\Domain\Entities\Product;

class CancelOrderHandler
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function handle(CancelOrderCommand $command)
    {
        $order = $this->orderRepository->findById($command->orderId);
        if ($order && $order->status == 'pending') {
            // Restock the product
            $product = Product::find($order->product_id);
            if ($product) {
                $product->increaseStock($order->quantity);
            }

            // Mark the order as canceled
            $order->status = 'canceled';
            $this->orderRepository->save($order);

            return $order;
        }
        return null; // Order not found or already processed
    }
}
