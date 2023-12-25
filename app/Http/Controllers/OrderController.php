<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $pageTitle = 'order';

        return view('Order.index', ['pageTitle' => $pageTitle]);
    }
}


