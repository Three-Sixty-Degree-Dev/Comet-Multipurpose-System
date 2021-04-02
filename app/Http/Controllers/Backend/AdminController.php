<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    //admin login
    public function showAdminLogin(){
        return view('backend.user.login');
    }
    //admin register
    public function showAdminRegister(){
        return view('backend.user.register');
    }
    //admin dashboard
    public function showAdminDashboard(){
        return view('backend.dashboard.dashboard');
    }

}
