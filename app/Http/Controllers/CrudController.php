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

public function processActivityForm(Request $request) {
    $order = Order::with('items')->where('order_id', $request->input('order_id'))->firstOrFail();

    $isFraudulent = false; // Assume the data is correct

    // Iterate through order items to check for mismatches
    foreach ($order->items as $item) {
        if ($item->serial_number != $request->input('serial_number') || $item->cobox_id != $request->input('cobox_id')) {
            $isFraudulent = true;
            break;
        }
    }

    $status = $isFraudulent ? 'fraud' : 'verified';

    // Record the fraud report
    $fraudReport = new FraudReport([
        'order_id' => $order->id,
        'user_id' => auth()->id(),
        'customer_name' => $order->customer_name,
        'cobox_id' => $request->input('cobox_id'),
        'serial_number' => $request->input('serial_number'),
        'location_map' => $request->input('location_map'),
        'status' => $status,
        'photo_path' => $request->file('photo')->store('public/fraud_reports')
    ]);
    $fraudReport->save();

    return redirect()->route('PointActivity')->with('status', $status);
}


    public function SelectedRegion(Request $request)
    {
        $request->validate([
            'Region' => 'required',
        ]);

        $data = [
            'id_region' => $request->Region,
        ];

        User::where('user_id', Auth::user()->user_id)->update($data);

        return redirect()->route('HomeUser');
    }


    //Users
    public function EditedUser(Request $request,  $id)
    {
        //$request->validate([
            //'Users' => 'required',
            //'username' => 'required',
            //'role' => 'required',
            //'Bisnis_Unit_Id' => 'required',
            //'id_region' => 'required',
        //]);

        $data = [
            'username' => $request->username,
            'Bisnis_Unit_Id' => $request->BisnisUnit,
            'role' => $request->Role,
            'id_region' => $request->Region,
        ];

        User::where('user_id', $id)->update($data);

        return redirect()->route('DataUser')->with('success', 'Succesfully Edit Category');

    }

    public function DeletedUser($id)
    {
        User::destroy($id);

        return redirect()->route('DataUser')->with('success', 'Succesfully Delete Enrollment');
    }
}
