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
        // Validar la solicitud entrante con los nuevos campos
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'zip' => 'required|integer',
            'delivery_date' => 'required|date',
            'status' => 'nullable|in:pending,completed,pagado,entregado,cancelado', // Validación del enum status
        ]);

        // Buscar el producto y calcular el total de la orden
        $product = Product::find($request->product_id);
        $totalAmount = $product->price * $request->quantity;

        // Crear la orden con los nuevos campos
        $order = Order::create([
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_amount' => $totalAmount,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
            'zip' => $request->zip,
            'delivery_date' => $request->delivery_date,
            'status' => $request->status ?? 'pending', // Por defecto es pending si no se proporciona
        ]);

        return response()->json($order, 201);
    }

    public function show($id)
    {
        return Order::with(['customer', 'product'])->findOrFail($id);
    }

    // src/app/Http/Controllers/OrderController.php

public function update(Request $request, $id)
{
    $order = Order::findOrFail($id);

    // Validar solo los campos editables
    $request->validate([
        'quantity' => 'required|integer|min:1',
        'status' => 'required|in:pending,completed,pagado,entregado,cancelado',
    ]);

    // Actualizar solo los campos que son editables
    $order->update($request->only(['quantity', 'status']));

    return response()->json($order, 200);
}


    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully']);
    }
}
