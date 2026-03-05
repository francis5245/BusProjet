<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    //
    public function ClientDashboard()
    {
        return view('Client.client-dashboard');
    }

}
