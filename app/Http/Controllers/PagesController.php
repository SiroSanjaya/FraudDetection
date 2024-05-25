<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BisnisUnit;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Region;
use App\Models\Order;
use App\Models\Point;
use App\Models\Shipment;
use App\Models\Role;
use App\Models\FraudReport;
use App\Models\FraudReportItem;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard')->with('success', 'Already Login');
        }

        return view('auth.login');
    }
    public function dashboard()
    {
        // if (empty(Auth::user()->role)) {
        //     return redirect()->route('SelectPosition')->with('success', 'You`r Not Selected Position Before, Please Select Position');
        // }

        // if (empty(Auth::user()->Bisnis_Unit_Id)) {
        //     return redirect()->route('SelectUnit')->with('success', 'You`r Not Selected Bisnis Unit Before, Please Select Position');
        // }

        // if (empty(Auth::user()->id_region)) {
        //     return redirect()->route('SelectRegion')->with('success', 'You`r Not Selected Region Before, Please Select Position');
        // }

        return view('admin.dashboard');
    }

    public function SelectPosition()
    {
        return view('SelectPosition', [
            'users' => User::all(),
            'role' => Role::all(),
        ]);
    }
    public function SelectUnit()
    {
        return view('SelectUnit', [
            'unit' => BisnisUnit::all(),
        ]);
    }

    public function SelectRegion()
    {
        return view('SelectRegion', [
            'Region' => Region::all(),
        ]);
    }


    public function DataOrder(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
    
        $pendingQuery = Order::whereNull('user_id');
        $createdQuery = Order::whereNotNull('user_id');
        $shippedQuery = Order::where('status', 'Shipped');
        $deliveredQuery = Order::where('status', 'Delivered');
        $completedQuery = Order::where('status', 'Completed');
    
        if ($search) {
            $pendingQuery->where(function ($q) use ($search) {
                $q->where('order_id', 'LIKE', "%$search%")
                  ->orWhereHas('customer', function ($q) use ($search) {
                      $q->where('name', 'LIKE', "%$search%");
                  });
            });
    
            $createdQuery->where(function ($q) use ($search) {
                $q->where('order_id', 'LIKE', "%$search%")
                  ->orWhereHas('customer', function ($q) use ($search) {
                      $q->where('name', 'LIKE', "%$search%");
                  });
            });
    
            $shippedQuery->where(function ($q) use ($search) {
                $q->where('order_id', 'LIKE', "%$search%")
                  ->orWhereHas('customer', function ($q) use ($search) {
                      $q->where('name', 'LIKE', "%$search%");
                  });
            });
    
            $deliveredQuery->where(function ($q) use ($search) {
                $q->where('order_id', 'LIKE', "%$search%")
                  ->orWhereHas('customer', function ($q) use ($search) {
                      $q->where('name', 'LIKE', "%$search%");
                  });
            });
    
            $completedQuery->where(function ($q) use ($search) {
                $q->where('order_id', 'LIKE', "%$search%")
                  ->orWhereHas('customer', function ($q) use ($search) {
                      $q->where('name', 'LIKE', "%$search%");
                  });
            });
        }
    
        if ($status) {
            if ($status == 'Fraud' || $status == 'Verified') {
                $completedQuery->whereHas('fraudReport', function ($q) use ($status) {
                    $q->where('status', $status);
                });
            } else {
                $completedQuery->where('status', $status);
            }
        }
    
        $pendingOrders = $pendingQuery->paginate(10);
        $createdOrders = $createdQuery->paginate(10);
        $shippedOrders = $shippedQuery->paginate(10);
        $deliveredOrders = $deliveredQuery->paginate(10);
        $completedOrders = $completedQuery->paginate(10);
    
        return view('admin.DataOrder', [
            'pendingOrders' => $pendingOrders,
            'createdOrders' => $createdOrders,
            'shippedOrders' => $shippedOrders,
            'deliveredOrders' => $deliveredOrders,
            'completedOrders' => $completedOrders,
        ]);
    }


    public function DetailOrder($orderId)
    {
        $order = Order::with(['customer', 'items', 'user'])->findOrFail($orderId);
        $users = User::all();

        // Mengambil satu shipment yang terkait dengan order_id tertentu
        $shipment = Shipment::with(['user', 'point', 'order'])
                             ->where('order_id', $orderId)
                             ->first();

        // Mengambil laporan kecurangan terkait dengan order_id tertentu
        $fraudReport = FraudReport::where('order_id', $orderId)->first();

        // Pastikan untuk mengirim $fraudReport ke view
        return view('admin.CrudDelivery.DetailOrder', compact('order', 'users', 'shipment', 'fraudReport'));
    }



    public function DetailFraud($orderId)
    {
        // Ambil data dari tabel Orders sesuai dengan order ID
        $order = Order::where('order_id', $orderId)->firstOrFail();

        // Ambil data dari tabel FraudReports sesuai dengan order ID
        $fraudReports = FraudReport::where('order_id', $orderId)->get();

        // Ambil semua item yang terkait dengan fraud reports
        $fraudReportItems = FraudReportItem::whereIn('fraud_report_id', $fraudReports->pluck('fraud_report_id'))->get();

        // Kirim data ke view
        return view('admin.CrudDelivery.DetailFraud', compact('order', 'fraudReports', 'fraudReportItems'));
    }


    public function DeliveryOrder()
    {
        $userId = Auth::id(); // Fetch the authenticated user's ID

        // Fetch orders assigned to the logged-in user with specific statuses
        $pendingOrders = Order::where('user_id', $userId)->where('status', 'Pending')->get();
        $shippedOrders = Order::where('user_id', $userId)->where('status', 'Shipped')->get();
        $deliveredOrders = Order::where('user_id', $userId)->where('status', 'Delivered')->get();

        // Calculate total orders for each status
        $pendingQuantity = $pendingOrders->count();
        $shippedQuantity = $shippedOrders->count();
        $deliveredQuantity = $deliveredOrders->count();

        // Pass data to the view
        return view('admin.DeliveryOrder', compact('pendingOrders', 'shippedOrders', 'deliveredOrders', 'pendingQuantity', 'shippedQuantity', 'deliveredQuantity'));
    }





    public function DetailDelivery($orderId)
    {
        $order = Order::with(['customer', 'items'])->findOrFail($orderId);
        $users = User::all();

        // Mengambil satu shipment yang terkait dengan order_id tertentu
        $shipment = Shipment::with(['user', 'point', 'order'])
                             ->where('order_id', $orderId)
                             ->first();

        // Pastikan untuk mengirim data ini ke view
        return view('admin.CrudDelivery.DetailDelivery', compact('order', 'users', 'shipment'));
    }



    // Point
public function DataPoint()
{

    $points = Point::all();
    return view('admin.DataPoint', ['points' => $points]);
}

    // Point
    public function AddPoint()
    {
        $points = Point::all();
        return view('admin.CrudPoint.AddPoint', ['points' => $points]);
    }
    
    public function EditPoint($id)
    {
        $point = Point::find($id); // Mengambil point berdasarkan ID
        if (!$point) {
            return redirect()->route('DataPoint')->with('error', 'Point not found.');
        }
        return view('admin.CrudPoint.EditPoint', compact('point'));
    }
// Point
public function Point()
{
    return view('admin.Point');
}

public function PointActivity()
{
    $userId = Auth::id(); // Mengambil ID user yang sedang login

    // Mengambil orders yang 'delivered' dan user_id di shipment sesuai dengan user yang login
    $createOrders = Order::with(['shipment.user'])
        ->whereHas('shipment', function ($query) use ($userId) {
            $query->where('user_id', $userId); // Filter shipment berdasarkan user_id
        })
        ->where('status', 'Delivered') // Hanya ambil yang statusnya 'Delivered'
        ->get();

    // Mengambil orders yang 'completed' dan user_id di shipment sesuai dengan user yang login
    $doneOrders = Order::with(['shipment.user'])
        ->whereHas('shipment', function ($query) use ($userId) {
            $query->where('user_id', $userId); // Filter shipment berdasarkan user_id
        })
        ->where('status', 'Completed') // Hanya ambil yang statusnya 'Completed'
        ->get();

    return view('admin.PointActivity', compact('createOrders', 'doneOrders'));
}



    public function PointDetail($orderId)
    {
        $order = Order::with(['customer', 'items'])->findOrFail($orderId);
        $users = User::all();

 // Mengambil laporan kecurangan terkait dengan order_id tertentu
 $fraudReport = FraudReport::where('order_id', $orderId)->first();
        // Mengambil satu shipment yang terkait dengan order_id tertentu
        $shipment = Shipment::with(['user', 'point', 'order'])
                             ->where('order_id', $orderId)
                             ->first();
        return view('admin.CrudPoint.PointDetail', compact('order', 'users', 'shipment', 'fraudReport'));
    }
    public function AddPointActivity($orderId)
    {
        $order = Order::with('user')->findOrFail($orderId);

        // Kirim data order ke view, yang juga mengandung data user
        return view('admin.CrudPoint.AddPointActivity', compact('order'));
    }


    //User



 }
