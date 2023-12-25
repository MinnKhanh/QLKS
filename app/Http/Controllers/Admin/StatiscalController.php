<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StatiscalController extends Controller
{
    public function index()
    {
        return view('admin.statiscal.index');
    }
    public function payment()
    {
        return view('admin.statiscal.payment');
    }
}
