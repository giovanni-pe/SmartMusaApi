<?php 
namespace App\Http\Controllers\CommerceAPI;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
class OrderController extends Controller
{
    public function index()
    {
        return Order::with(['customer', 'product'])->get();
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Fetch the product and calculate total amount
        $product = Product::find($request->product_id);
        $totalAmount = $product->price * $request->quantity;

        // Create the order
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        return response()->json($order, 201);
    }

    public function show($id)
    {
        return Order::with(['customer', 'product', 'payment'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());

        return $order;
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully']);
    }
}
