<?php 

namespace App\Http\Controllers\CommerceAPI;

use App\Models\Payment;
use App\Models\Order;
use Illuminate\Http\Request;
use Culqi\Culqi;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    protected $culqi;

    public function __construct()
    {
        $this->culqi = new Culqi(['api_key' => env('CULQI_SECRET_KEY')]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'amount' => 'required|numeric',
            'email' => 'required|email',
            'token' => 'required|string'
        ]);

        $order = Order::find($request->order_id);

        try {
            // Create charge using Culqi
            $charge = $this->culqi->Charges->create([
                'amount' => $request->amount * 100, // Amount in cents
                'currency_code' => 'PEN',
                'email' => $request->email,
                'source_id' => $request->token,
                'description' => 'Order Payment'
            ]);

            // Save payment details
            $payment = Payment::create([
                'order_id' => $order->id,
                'amount' => $request->amount,
                'transaction_id' => $charge->id,
                'status' => 'completed'
            ]);

            // Update order status to completed
            $order->update(['status' => 'pagado']);

            return response()->json(['message' => 'Payment processed successfully', 'payment' => $payment], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Payment failed', 'message' => $e->getMessage()], 500);
        }
    }
}
