<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function top(Request $request) 
    {
        // dd($request);
    return view('home.index');
    }
}
