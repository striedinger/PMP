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
    public function index()
    {
        $exams = \App\Exam::orderBy('type')->get();
        $areas = \App\Area::lists('name', 'id');
        $processes = \App\Process::lists('name', 'id');
        return view('home', [
            'exams' => $exams,
            'areas' => $areas,
            'processes' => $processes
        ]);
    }
}
