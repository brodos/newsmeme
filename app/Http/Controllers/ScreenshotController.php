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

    public function show() 
    {
        $data = request()->validate([
            'title'  => 'required|min:1|max:255',
            'subtitle'  => 'required|min:1|max:255',
            'subnews'  => 'required|min:1|max:255',
            'time' => 'nullable',
            'city' => 'nullable',
            'live' => 'nullable',
            'newsalert' => 'nullable',
            'breakingnews' => 'nullable',
            'cover' => 'nullable',
        ]);
        
        return view('screenshot', compact('data'));
    }

    public function store(Request $request) 
    {



        return view('screenshot');
    }
}
