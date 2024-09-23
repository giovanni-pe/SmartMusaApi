<?php 
namespace App\API\Http\Controllers;

use App\Application\Commands\ProcessPaymentCommand;
use App\Application\Handlers\ProcessPaymentHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class PaymentController extends Controller
{
    protected $processPaymentHandler;

    public function __construct(ProcessPaymentHandler $processPaymentHandler)
    {
        $this->processPaymentHandler = $processPaymentHandler;
    }

    public function processPayment(Request $request)
    {
        $command = new ProcessPaymentCommand(
            $request->input('order_id'),
            $request->input('amount'),
            $request->input('transaction_id'),
            $request->input('status', 'pending')
        );

        $payment = $this->processPaymentHandler->handle($command);

        return response()->json($payment, 200);
    }
}
