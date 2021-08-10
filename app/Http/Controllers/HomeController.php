<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
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
    public function index(Request $request)
    {
        $description    =   $request->description;
        $name           =   $request->name;

        $images = Image::orderByDesc('created_at')
                ->description($description)
                ->name($name)
                ->paginate(3);

        return view('home', compact('images'));
    }
}
