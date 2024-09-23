<?php 
namespace App\Domain\Services;

use App\Domain\Entities\Payment;

class PaymentService
{
    public function processPayment($orderId, $amount, $transactionId = null, $status = 'pending')
    {
        $payment = new Payment([
            'order_id' => $orderId,
            'amount' => $amount,
            'transaction_id' => $transactionId,
            'status' => $status,
        ]);

        $payment->save();
        return $payment;
    }
}
