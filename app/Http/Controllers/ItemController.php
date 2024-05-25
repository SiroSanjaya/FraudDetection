<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with('product')->get();
        $products = Product::all();
        return view('items.index', compact('items','products'));
    }

    public function create()
    {
        $products = Product::all(); // Fetch all products
        $coboxNames = ['Fish', 'Shrimp']; // Example fixed cobox names
        return view('items.create', compact('products', 'coboxNames'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity' => 'required|integer|min:1',
            'is_available' => 'required|boolean',
            'cobox_name' => 'required|string|max:255'
        ]);

        DB::transaction(function () use ($validated) {
            $product = Product::findOrFail($validated['product_id']);

            for ($i = 0; $i < $validated['quantity']; $i++) {
                Item::create([
                    'product_id' => $validated['product_id'],
                    'item_serial_number' => $this->generateSerialNumber(),
                    'is_available' => $validated['is_available'],
                    'cobox_name' => $validated['cobox_name'],
                    'cobox_id' => $this->generateCoboxId()
                ]);
            }

            // Update the product's stock based on available items
            if ($validated['is_available']) {
                $product->increment('stock', $validated['quantity']);
            }

            Log::info('Items created and product stock updated.', ['product_id' => $product->id, 'quantity' => $validated['quantity']]);
        });

        return redirect()->route('items.index')->with('success', "Items created successfully and product stock updated.");
    }

    private function generateSerialNumber()
    {
        return sprintf('TBFF-%04X-%04X-%04X',
            mt_rand(0, 0xFFFF),
            mt_rand(0, 0xFFFF),
            mt_rand(0, 0xFFFF));
    }

    private function generateCoboxId()
    {
        return sprintf('%02d%s%02d-%s%09d%s-%s-%s%s',
            mt_rand(0, 99),
            chr(mt_rand(65, 90)),
            mt_rand(0, 99),
            'SS',
            mt_rand(0, 999999999),
            'R',
            chr(mt_rand(65, 90)),
            'NWL',
            chr(mt_rand(65, 90))
        );
    }
}
