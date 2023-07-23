<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\BisnisUnit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function Login()
    {
        return view('auth.Login');
    }
    public function SelectUnit()
    {
        return view('SelectUnit', [
            'unit' => BisnisUnit::all(),
        ]);
    }
    public function SelectedUnit(Request $request)
    {
        $request->validate([
            'BisnisUnit' => 'required',
        ]);

        $data = [
            'BisnisID' => $request->BisnisUnit,
        ];

        User::where('UserID', Auth::user()->UserID)->update($data);

        return redirect()->route('dashboard');
    }
}