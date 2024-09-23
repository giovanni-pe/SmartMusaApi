<?php
namespace App\Application\Commands;

class CreateOrderCommand
{
    public $customer;
    public $product;
    public $quantity;
    public $totalAmount;

    public function __construct($customer, $product, $quantity, $totalAmount)
    {
        $this->customer = $customer;
        $this->product = $product;
        $this->quantity = $quantity;
        $this->totalAmount = $totalAmount;
    }
}
