<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenjagaController extends Controller
{
    public function dashboard()
    {
        return view('dashboard_penjaga');
    }
}
