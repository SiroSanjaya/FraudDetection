<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EmailController extends Controller
{
    /**
     * Show the form for sending an email.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showForm()
    {
        return view('send_email'); // Make sure the view exists under resources/views/send_email.blade.php
    }

  
}
