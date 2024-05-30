<?php
namespace App\Http\Controllers;

use App\Models\ItemNew;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ItemController extends Controller
{
    public function index()
    {
        $items = ItemNew::with('product')->get();
        $products = Product::all();
        return view('items.index', compact('items', 'products'));
    }

    public function create()
    {
        $products = Product::all();
        $coboxNames = ['Fish', 'Shrimp'];
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
                ItemNew::create([
                    'product_id' => $validated['product_id'],
                    'item_serial_number' => $this->generateSerialNumber(),
                    'is_available' => $validated['is_available'],
                    'cobox_name' => $validated['cobox_name'],
                    'cobox_id' => $this->generateCoboxId(),
                    'order_id' => null
                ]);
            }

            Log::info('Items created and product stock updated.', ['product_id' => $product->product_id, 'quantity' => $validated['quantity']]);
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
    public function generateQRCode($serialNumber, $productType, $coboxId)
    {
        $serialNumberQrCode = base64_encode(QrCode::format('svg')->size(200)->generate($serialNumber));
        $coboxIdQrCode = base64_encode(QrCode::format('svg')->size(200)->generate($coboxId));

        return view('items.qr-code', [
            'serialNumberQrCode' => $serialNumberQrCode,
            'coboxIdQrCode' => $coboxIdQrCode,
            'productType' => $productType,
            'serialNumber' => $serialNumber,
            'coboxId' => $coboxId
        ]);
    }
}
