<?php 
namespace App\Application\Commands;

class ProcessPaymentCommand
{
    public $orderId;
    public $amount;
    public $transactionId;
    public $status;

    public function __construct($orderId, $amount, $transactionId = null, $status = 'pending')
    {
        $this->orderId = $orderId;
        $this->amount = $amount;
        $this->transactionId = $transactionId;
        $this->status = $status;
    }
}
