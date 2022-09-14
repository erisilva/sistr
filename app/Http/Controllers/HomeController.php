<?php

namespace App\Http\Controllers;

use App\Models\Tr;

use Illuminate\Http\Request;

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
        return view('home', [
            'criadas' => Tr::orderBy('ano', 'desc')->orderBy('numero', 'desc')->limit(5)->get(),
            'alteradas' => Tr::orderBy('updated_at', 'desc')->limit(5)->get()
        ]);
    }
}
