<?php
namespace App\API\Http\Controllers;

use App\Application\Commands\CreateOrderCommand;
use App\Application\Commands\CancelOrderCommand;
use App\Application\Handlers\CreateOrderHandler;
use App\Application\Handlers\CancelOrderHandler;
use App\Domain\Entities\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class OrderController extends Controller
{
    protected $createOrderHandler;
    protected $cancelOrderHandler;

    public function __construct(CreateOrderHandler $createOrderHandler, CancelOrderHandler $cancelOrderHandler)
    {
        $this->createOrderHandler = $createOrderHandler;
        $this->cancelOrderHandler = $cancelOrderHandler;
    }

    // Create a new order
    public function createOrder(Request $request)
    {
        $command = new CreateOrderCommand(
            $request->input('customer'),
            $request->input('product'),
            $request->input('quantity'),
            $request->input('totalAmount')
        );

        $order = $this->createOrderHandler->handle($command);
        return response()->json($order, 201);
    }

    // Cancel an existing order
    public function cancelOrder($orderId)
    {
        $command = new CancelOrderCommand($orderId);
        $order = $this->cancelOrderHandler->handle($command);

        if ($order) {
            return response()->json(['message' => 'Order canceled successfully.'], 200);
        }
        return response()->json(['message' => 'Order could not be canceled.'], 404);
    }

    // Fetch all orders
    public function getAllOrders()
    {
        $orders = Order::getAllOrders();
        return response()->json($orders, 200);
    }
}
