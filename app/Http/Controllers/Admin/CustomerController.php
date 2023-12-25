<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('admin.customer.list-customer');
    }
    public function detail(Request $request, $id)
    {
        return view('admin.customer.booking-room', ['id' => $id]);
    }
}
