<?php 

namespace App\Application\Handlers;

use App\Application\Commands\ProcessPaymentCommand;
use App\Domain\Services\PaymentService;

class ProcessPaymentHandler
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function handle(ProcessPaymentCommand $command)
    {
        return $this->paymentService->processPayment($command->orderId, $command->amount, $command->transactionId, $command->status);
    }
}
