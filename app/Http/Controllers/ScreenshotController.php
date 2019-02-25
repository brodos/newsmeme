<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScreenshotController extends Controller
{
    /**
     * Show the application index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('build');
    }

    public function store(Request $request) 
    {
        dd($request);
    }
}
