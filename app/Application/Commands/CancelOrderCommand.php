<?php 
namespace App\Application\Commands;

class CancelOrderCommand
{
    public $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }
}
