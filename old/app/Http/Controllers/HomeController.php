<?php

namespace App\Http\Controllers;

use App\Models\Infos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
    public function index(Request $request)
    {
        $users = User::latest();
        $infos = Infos::latest();

        $userId = $request->cookie('user_id') ?? (string) Str::uuid();
        return response()
            ->view('home', compact('users', 'infos'))
            ->cookie('user_id', $userId, 60 * 24 * 365);
    }
}
