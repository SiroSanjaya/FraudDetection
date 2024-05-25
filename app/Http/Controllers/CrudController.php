<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AnswereQuestion;
use App\Models\BisnisUnit;
use App\Models\CategoryCourses;
use App\Models\Certificate;
use App\Models\Courses;
use App\Models\Enroll;
use App\Models\Enrollment;
use App\Models\OptionQuestion;
use App\Models\QuestionQuiz;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Videos;
use App\Models\Region;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Shipment;
use App\Models\FraudReport;
use App\Models\FraudReportItem;
use App\Models\Point;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class CrudController extends Controller
{
    // Select Position
  public function SelectedPosition(Request $request)
{
    $request->validate([
        'Position' => 'required',
    ]);

    $data = [
        'role_Id' => $request->Position,
    ];

    User::where('user_id', Auth::user()->user_id)->update($data);

    // if (Auth::user()->role === 'FTS' || Auth::user()->role === null) {
    //     return redirect()->route('SelectUnit');
    // } else  {
       return redirect()->route('dashboard');
     //}
}

public function assignDriver(Request $request)
{

    \Log::info('Request Data:', $request->all()); // Ini akan menampilkan semua data yang dikirim ke log

    $validatedData = $request->validate([
        'order_id' => 'required|exists:orders,order_id',
        'assigned_user_id' => 'required|exists:users,user_id'
    ]);

    \Log::info('Validated Data:', $validatedData);

    $order = Order::findOrFail($validatedData['order_id']);
    $order->user_id = $validatedData['assigned_user_id'];
    $order->save();

    return redirect()->route('DataOrder')->with('success', 'Driver assigned successfully.');
}

public function acceptOrder($orderId)
{
    $order = Order::with('shipment')->findOrFail($orderId);
    $order->status = 'shipped';
    $order->save();

    if ($order->shipment) {
        $order->shipment->status = 'shipped'; // Pastikan juga model Shipment sudah diatur dengan benar
        $order->shipment->save();
    }

    return redirect()->route('DeliveryOrder')->with('success', 'Order has been accepted and status updated to shipped.');
}

public function finishDelivery($orderId)
{
    $order = Order::findOrFail($orderId);
    $order->status = 'delivered';
    $order->save();

    return redirect()->route('DeliveryOrder')->with('success', 'Delivery has been finished successfully.');
}

public function cancelOrder(Request $request, $orderId)
{
    $order = Order::find($orderId);
    if ($order && $order->status == 'Pending') {
        $order->user_id = null;
        $order->save();
        return redirect()->route('DeliveryOrder')->with('error', 'Order could not be cancelled.');
    }

    return redirect()->route('DeliveryOrder')->with('error', 'Order could not be cancelled.');
}


public function processActivityForm(Request $request) {
    // Ambil order sesuai dengan order_id yang diberikan di request
    $order = Order::with('items')->where('order_id', $request->input('order_id'))->firstOrFail();

    // Flag untuk menandai jika ada kecurangan
    $isFraudulent = false;

    // Ambil items dari request
    $requestItems = $request->input('items');

    // Iterasi melalui item-item pesanan untuk memeriksa kecurangan
    foreach ($order->items as $index => $item) {
        // Ambil serial_number dan cobox_id dari request untuk item saat ini
        $requestSerialNumber = $requestItems[$index]['serial_number'] ?? null;
        $requestCoboxId = $requestItems[$index]['cobox_id'] ?? null;

        // Periksa apakah serial_number atau cobox_id tidak sesuai
        if ($item->serial_number != $requestSerialNumber || $item->cobox_id != $requestCoboxId) {
            $isFraudulent = true;
            break;
        }
    }

    // Validasi tambahan untuk memeriksa apakah location_map sama dengan location_map dari point_name
    if ($request->input('location_map') !== $request->input('point_name')) {
        $isFraudulent = true;
    }

    // Tentukan status berdasarkan hasil pemeriksaan kecurangan
    $status = $isFraudulent ? 'fraud' : 'verified';

    // Cek apakah customer_name sudah ada dalam request, jika tidak kosong, gunakan nilainya, jika kosong, tetapkan null
    $customerName = $request->input('customer_name', null);
    $point_name = $request->input('point_name');

    // Simpan laporan kecurangan beserta informasi lainnya
    $fraudReport = FraudReport::create([
        'order_id' => $order->order_id,
        'user_id' => auth()->id(),
        'customer_name' => $customerName,
        'location_map' => $request->input('location_map'),
        'status' => $status,
        'point_name' => $point_name,
        'photo_path' => $request->file('photo')->store('fraud_reports', 'public')
    ]);

    // Update status pesanan menjadi 'done' terlepas dari apakah ada kecurangan atau tidak
    $order->update(['status' => 'Completed']);

    // Periksa apakah $fraudReport telah dibuat dengan benar
    if ($fraudReport) {
        // Simpan item cobox_id dan serial_number ke tabel FraudReportItems
        foreach ($requestItems as $item) {
            FraudReportItem::create([
                'fraud_report_id' => $fraudReport->fraud_report_id, // Menggunakan id dari $fraudReport
                'cobox_id' => $item['cobox_id'],
                'serial_number' => $item['serial_number']
            ]);
        }
    }

    // Redirect ke halaman PointActivity dengan status
    return redirect()->route('PointActivity')->with('status', $status);
}


public function CreatePoint(Request $request)
{
    // Validasi data yang dikirim dari formulir
    $validatedData = $request->validate([
        'point_name' => 'required|string',
        'location' => 'required|string',
        // Jika ada field lain, tambahkan di sini
    ]);

    // Lakukan sesuatu dengan data yang diterima, seperti menyimpannya ke database
    $point = new Point();
    $point->point_name = $request->input('point_name');
    $point->location = $request->input('location');
    // Lakukan operasi lain yang diperlukan, misalnya validasi lebih lanjut, dll.
    $point->save();

    // Redirect ke halaman yang sesuai atau kembali ke halaman sebelumnya
    return redirect()->route('DataPoint')->with('success', 'Titik berhasil ditambahkan!');
}

public function UpdatePoint(Request $request, $id)
{
    $request->validate([
        'point_name' => 'required',
        'location' => 'required',
    ]);

    $point = Point::find($id);
    if (!$point) {
        return redirect()->route('DataPoint')->with('error', 'Point not found.');
    }

    $point->point_name = $request->point_name;
    $point->location = $request->location;
    $point->save();

    return redirect()->route('DataPoint')->with('success', 'Point updated successfully.');
}

public function delete($id)
{
    $point = Point::find($id);

    if (!$point) {
        return redirect()->route('DataPoint')->with('error', 'Titik tidak ditemukan.');
    }

    $point->delete();

    return redirect()->route('DataPoint')->with('success', 'Titik berhasil dihapus.');
}

public function searchOrders(Request $request)
{
    
    $search = $request->input('search');
    // Proses pencarian
}
}
