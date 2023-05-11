<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResvManageController extends Controller
{
    public function index()
    {
        return view('manage');
    }
}
