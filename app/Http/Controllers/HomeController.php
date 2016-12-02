<?php

namespace App\Http\Controllers;

use App\Http\Requests;
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
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('home');
    }

    public function index_ajax(){
        if(\Request::ajax()) {
            return view('home_ajax');
        } else {
            return view('home');
        }
    }

    public function getPanel(){
        if(\Request::ajax()) {
           return view('vista2');
        } else {
            return view('home');
        }
    }
}
