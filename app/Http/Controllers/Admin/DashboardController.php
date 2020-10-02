<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
     /**
     * Admin Dashboard page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.dashboard');
    }

}
