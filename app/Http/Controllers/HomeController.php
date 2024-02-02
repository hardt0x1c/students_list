<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Abiturent;

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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $abiturent = Abiturent::where('email', $user->email)->first();

        return view('home', compact('user', 'abiturent'));
    }
}
