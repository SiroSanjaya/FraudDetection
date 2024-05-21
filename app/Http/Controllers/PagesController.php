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
use App\Models\Role;
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






    public function DataOrder()
    {
        // Fetch all orders with necessary relationships
        $orders = Order::with(['user', 'customer', 'point'])->get();
    
        // Filter orders based on their status
        $pendingOrders = $orders->where('status', 'pending');
        $createdOrders = $orders->whereNotNull('user_id');
        $shippedOrders = $orders->where('status', 'shipped');
        $deliveredOrders = $orders->where('status', 'delivered');
        $drivers = User::role('driver')->get();  // Assuming you are using a package like spatie/laravel-permission
    
        return view('admin.DataOrder', [
            'orders' => $orders,
            'pendingOrders' => $pendingOrders,
            'createdOrders' => $createdOrders,
            'shippedOrders' => $shippedOrders,
            'deliveredOrders' => $deliveredOrders,
            'drivers' => $drivers
        ]);
    }


    public function DeliveryOrder()
    {
        $userId = Auth::id(); // Fetch the authenticated user's ID
        $orders = Order::where('user_id', $userId)->get(); // Fetch orders assigned to the logged-in user
        $orders = Order::with('shipment.user')->where('user_id', $userId)->get();
        $pendingOrders = Order::with('shipment.user')->where('user_id', $userId)->where('status', 'pending')->get();
        $shippedOrders = Order::with('shipment.user')->where('user_id', $userId)->where('status', 'shipped')->get();
        $deliveredOrders = Order::with('shipment.user')->where('user_id', $userId)->where('status', 'delivered')->get();

        return view('admin.DeliveryOrder', compact('pendingOrders', 'shippedOrders', 'deliveredOrders'));
    }

    public function DetailOrder($orderId)
    {
        $order = Order::with(['customer', 'items'])->findOrFail($orderId);
        $users = User::role('driver')->get();

        // Mengambil satu shipment yang terkait dengan order_id tertentu
        $shipment = Shipment::with(['user', 'point', 'order'])
                             ->where('order_id', $orderId)
                             ->first();

        // Pastikan untuk mengirim $shipment ke view
        return view('admin.CrudDelivery.DetailOrder', compact('order', 'users', 'shipment'));
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
public function Point()
{
    return view('admin.Point');
}
public function PointActivity()
{
    $userId = Auth::id(); // Mengambil ID user yang sedang login

    // Mengambil orders yang 'delivered' dan user_id di shipment sesuai dengan user yang login
    $orders = Order::with(['shipment.user'])
        ->whereHas('shipment', function ($query) use ($userId) {
            $query->where('user_id', $userId); // Filter shipment berdasarkan user_id
        })
        ->where('status', 'delivered') // Hanya ambil yang statusnya 'delivered'
        ->get();

    return view('admin.PointActivity', compact('orders'));
}

    public function PointDetail($orderId)
    {
        $order = Order::with(['customer', 'items'])->findOrFail($orderId);
        $users = User::all();

        // Mengambil satu shipment yang terkait dengan order_id tertentu
        $shipment = Shipment::with(['user', 'point', 'order'])
                             ->where('order_id', $orderId)
                             ->first();
        return view('admin.CrudPoint.PointDetail', compact('order', 'users', 'shipment'));
    }
    public function AddPointActivity($orderId)
    {
        $order = Order::with('user')->findOrFail($orderId);

        // Kirim data order ke view, yang juga mengandung data user
        return view('admin.CrudPoint.AddPointActivity', compact('order'));
    }


    public function DataUser()
    {
        return view('admin.DataUser', [
            'users' =>  User::all(),
            //'BisnisUnit' => BisnisUnit::all(),
            //'Region' => Region::all()
        ]);
    }



    //User

    public function HomeUser()
    {
        if (empty(Auth::user()->role)) {
            return redirect()->route('SelectPosition')->with('success', 'You`r Not Selected Position Before, Please Select Position');
        }

        if (Auth::user()->role === 'fts' && empty(Auth::user()->Bisnis_Unit_Id)) {
            return redirect()->route('SelectUnit')->with('success', 'You`r Not Selected Bisnis Unit Before, Please Select Bisnis Unit');
        }

        if (Auth::user()->role === 'fts' && empty(Auth::user()->id_region)) {
            return redirect()->route('SelectRegion')->with('success', 'You`r Not Selected Bisnis Unit Before, Please Select Bisnis Unit');
        }

        return view('users.HomeUser', [
            'CategoryCourses' => CategoryCourses::all(),
            'Courses' => Courses::all()
        ]);
    }



 }
