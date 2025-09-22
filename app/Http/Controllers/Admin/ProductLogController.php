<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductLog;
use Illuminate\Http\Request;

class ProductLogController extends Controller
{
    public function index()
    {
        $logs = ProductLog::latest()->paginate(15);
        return view('admin.product-logs.index', compact('logs'));
    }
}
