<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Point;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */

     public function index(Request $request)
     {
         $sort = $request->query('sort', 'latest');
         $orderQuery = Order::with(['customer', 'point', 'user']);
         
         if ($sort === 'latest') {
             $orderQuery->orderBy('created_at', 'desc');
         } else if ($sort === 'oldest') {
             $orderQuery->orderBy('created_at', 'asc');
         }
     
         $orders = $orderQuery->get();
         return view('orders.index', compact('orders'));
     }

public function show($orderId)
{
    $order = Order::with(['customer', 'user', 'orderItems.product'])->findOrFail($orderId);
    return view('orders.show', compact('order'));
}

public function storeWithItems(Request $request)
{
    Log::info('StoreWithItems method called with request data:', $request->all());

    $validated = $request->validate([
        'customer_id' => 'required|exists:customers,customer_id',
        'user_id' => 'required|exists:users,user_id',
        'point_id' => 'required|exists:points,point_id',
        'items' => 'required|array',
        'items.*.product_id' => 'required|exists:items,product_id',
        'items.*.quantity' => 'required|integer|min:1',
    ]);

    Log::info('Request data validated successfully.');

    try {
        $order = new Order();
        $order->order_id = $this->generateOrderId(); // Set the custom generated order ID
        $order->customer_id = $request->customer_id;
        $order->user_id = $request->user_id;
        $order->point_id = $request->point_id;
        $order->status = 'Pending'; // Default status, or use $request->status if it's set dynamically
        $order->order_date = now();
        $order->save();

        Log::info('Order created successfully:', ['order_id' => $order->order_id]);

        $totalAmount = 0;

        foreach ($validated['items'] as $itemData) {
            $item = Item::findOrFail($itemData['product_id']);
            $totalAmount += $item->price * $itemData['quantity'];

            // Create order items
            $order->items()->create([
                'product_id' => $itemData['product_id'],
                'quantity' => $itemData['quantity'],
                'serial_number' => $item->serial_number,
                'cobox_id' => $item->cobox_id,
            ]);

            Log::info('Order item created:', ['product_id' => $itemData['product_id'], 'quantity' => $itemData['quantity']]);

            // Update product stock, if necessary
            $item->decrement('stock', $itemData['quantity']);
        }

        $order->total_amount = $totalAmount;
        $order->save();

        Log::info('Order total amount updated:', ['total_amount' => $totalAmount]);

        return redirect()->route('orders.index')->with('success', 'Order created successfully with custom Order ID.');
    } catch (\Exception $e) {
        Log::error('Error creating order:', ['error' => $e->getMessage()]);
        return redirect()->route('orders.create')->with('error', 'There was an error creating the order.');
    }
}
     
     

    /**
     * Show the form for creating a new order.
     */
    public function create()
    {
        $customers = Customer::all(); // Fetch all customers
        $users = User::role('sales')->get(); // Fetch all users with the 'sales' role
        $points = Point::all(); // Fetch all points
        $items = Item::with('product')->get(); // Fetch all items with product details
        $products = Product::all(); // Fetch all products

        return view('orders.create', compact('products','customers', 'users', 'points', 'items'));
    }
    

    public function store(Request $request)
    {
        Log::info('Store method called with request data:', $request->all());
    
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'user_id' => 'required|exists:users,user_id',
            'point_id' => 'required|exists:points,point_id',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,product_id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);
    
        Log::info('Request data validated successfully.');
    
        try {
            $order = new Order();
            $order->order_id = $this->generateOrderId(); // Set the custom generated order ID
            $order->customer_id = $request->customer_id;
            $order->user_id = $request->user_id;
            $order->point_id = $request->point_id;
            $order->status = 'Pending'; // Default status, or use $request->status if it's set dynamically
            $order->order_date = now();
            $order->save();
    
            Log::info('Order created successfully:', ['order_id' => $order->order_id]);
    
            $totalAmount = 0;
    
            foreach ($validated['items'] as $itemData) {
                $product = Product::findOrFail($itemData['product_id']);
                $totalAmount += $product->price * $itemData['quantity'];
    
                // Create order items
                $order->orderItems()->create([
                    'product_id' => $itemData['product_id'],
                    'quantity' => $itemData['quantity'],
                    'serial_number' => $product->serial_number, // Assuming serial_number comes from the product
                    'cobox_id' => $product->cobox_id, // Assuming cobox_id comes from the product
                ]);
    
                Log::info('Order item created:', ['product_id' => $itemData['product_id'], 'quantity' => $itemData['quantity']]);
    
                // Update product stock, if necessary
                $product->decrement('stock', $itemData['quantity']);
            }
    
            $order->total_amount = $totalAmount;
            $order->save();
    
            Log::info('Order total amount updated:', ['total_amount' => $totalAmount]);
    
            return redirect()->route('orders.index')->with('success', 'Order created successfully with custom Order ID.');
        } catch (\Exception $e) {
            Log::error('Error creating order:', ['error' => $e->getMessage()]);
            return redirect()->route('orders.create')->with('error', 'There was an error creating the order.');
        }
    }
    
    /**
     * Show the form for editing the specified order.
     */
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'order_date' => 'date',
            'total_amount' => 'numeric',
            'status' => 'string',
            'customer_id' => 'exists:customers,customer_id',
            'point_id' => 'exists:points,point_id',
        ]);

        $order = Order::findOrFail($id);
        $order->update($validated);
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
        /**
     * Generate a unique Order ID.
     */
    public static function generateOrderId()
    {
        $four_digit_number = rand(1000, 9999);
        $two_digit_number1 = rand(10, 99);
        $two_digit_number2 = rand(10, 99);
        $four_alphabet = strtoupper(substr(bin2hex(random_bytes(2)), 0, 4)); // Generate 4 random uppercase letters

        return "ASD-{$four_digit_number}-FDR-{$two_digit_number1}-{$two_digit_number2}-{$four_alphabet}";
    }

}
