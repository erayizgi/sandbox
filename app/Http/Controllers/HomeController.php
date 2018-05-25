<?php

namespace App\Http\Controllers;

use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
        if(Auth::check()){
            $user = Auth::user();
            $client = new Client();
            $client->post("http://lotoxl.test/oauth/token",[
                "client_id"=>2,
                "client_secret" => "ooJ4XNKKZ27SYT2cZuaKymLbuYQT7enkSl5nir7A",
                "grant_type" => "password",
                "password" => "123456",
                "username" => "test@test.com",
            ]);
        }
        return view('home');
    }
}
