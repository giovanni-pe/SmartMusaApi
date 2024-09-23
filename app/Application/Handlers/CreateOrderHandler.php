<?php 
namespace App\Application\Handlers;

use App\Application\Commands\CreateOrderCommand;
use App\Domain\Services\OrderService;
use App\Domain\Entities\Customer;

class CreateOrderHandler
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function handle(CreateOrderCommand $command)
    {
        $customer = new Customer($command->customer['name'], $command->customer['email'], $command->customer['phone']);
        return $this->orderService->createOrder($customer, $command->product, $command->quantity, $command->totalAmount);
    }
}
