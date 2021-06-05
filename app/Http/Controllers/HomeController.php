<?php

namespace App\Http\Controllers;

use App\Question;
use App\User;
use App\UserTest;
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
        //..
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'totalQuestions'    =>  Question::count(),
        ];

        if (Auth::user()->isAdmin()) {
            $data['totalUsers'] = User::ordinary()->count();
            $data['totalTestsConducted'] = UserTest::inActive()->count();
        } else {
            $data['userTests'] = Auth::user()->tests;
        }

        return view('home', $data);
    }
}
