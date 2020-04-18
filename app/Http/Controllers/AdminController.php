<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Video;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * show dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response_data["free"] = Video::whereCategoryType(1)->count();
        $response_data["subscribe"] = Video::whereCategoryType(1)->count();
        $response_data["user"] = User::count();
        return view('admin-dashboard')->with($response_data);
    }
}
