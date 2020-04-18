<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\UserVideoLike;
use App\VideoSubscribe;
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
        $response_data["like"] = UserVideoLike::whereUserId(Auth::user()->id)->count();
        $response_data["subscribe"] = VideoSubscribe::whereUserId(Auth::user()->id)->count();
        return view('home')->with($response_data);
    }
}
