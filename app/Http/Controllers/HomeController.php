<?php

namespace App\Http\Controllers;

use App\Models\Application;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        if(auth()->user()->role === 1){
            return view('admin.dashboard', [
                'applications' => Application::orderBy('created_at')->where('status', 'pending')->paginate(3)
            ]);
        }

        return view('user.dashboard', [
            'filter' => '',
            'applications' => auth()->user()->applications
        ]);

    }
}
