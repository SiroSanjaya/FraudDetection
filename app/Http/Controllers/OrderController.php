<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use App\Models\Point;
use App\Models\Item;
use App\Models\Product;

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
     public function show($id)
     {
         // Retrieve the order along with its associated customer, user (salesperson), and items
         $order = Order::with(['customer', 'user', 'items.product'])->findOrFail($id);
 
         // Return the show view with the order data
         return view('orders.show', compact('order'));
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
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'user_id' => 'required|exists:users,user_id',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:0',
        ]);
    
        $order = new Order();
        $order->order_id = $this->generateOrderId(); // Set the custom generated order ID
        $order->customer_id = $request->customer_id;
        $order->user_id = $request->user_id;
        $order->status = 'Pending'; // Default status, or use $request->status if it's set dynamically
        $order->order_date = now();
        $order->save();
    
        $totalAmount = 0;
    
        foreach ($request->quantities as $productId => $quantity) {
            if ($quantity > 0) {
                $product = Product::findOrFail($productId);
                $totalAmount += $product->price * $quantity;
    
                // Create order items or similar logic
                $order->items()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    // other necessary fields
                ]);
    
                // Update product stock, if necessary
                $product->decrement('stock', $quantity);
            }
        }
    
        $order->total_amount = $totalAmount;
        $order->save();
    
        return redirect()->route('orders.index')->with('success', 'Order created successfully with custom Order ID.');
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
