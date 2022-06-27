<?php

namespace App\Http\Controllers;

use App\Models\Application;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        if(auth()->user()->role === 1){
            return view('admin.dashboard', [
                'applications' => Application::orderBy('created_at')->where('status', 'pending')->paginate(10)
            ]);
        }

        return view('user.dashboard', [
            'filter' => '',
            'daysTaken' => array_sum(auth()->user()->applications->where('status', 'approved')->pluck('days')->toArray()),
            'applications' => auth()->user()->applications
        ]);

    }

    public function adminDashboard() {
        return 'Admin';
    }
}
