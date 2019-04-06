<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Artisan;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

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

    /**
     * Show the compiled screenshot
     * 
     * @return view
     */
    public function show() 
    {
	$server_ip = $_SERVER['HTTP_X_FORWARDED_FOR'] ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

        // only allow the server to access this page
        if ($server_ip != '116.203.79.183') {
            return redirect()->route('home');
        }

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

    /**
     * Creates a screenshot file
     * @param  Request $request 
     * @return JSON
     */
    public function store(Request $request) 
    {   
        // validate data
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

        // prepare path
        $image_name = md5(time()) . '.jpg';

        $dir = sprintf('%s/%s/%s/', storage_path('app/public/screenshots'), date('Y'), date('m'));

        if (! is_dir($dir))
            mkdir($dir, 0770, true);

        $path = $dir . $image_name;

        $public_path = asset(sprintf('/screenshots/%s/%s/%s', date('Y'), date('m'), $image_name));

        // take the screenshot
        Artisan::call('screenshot:take', [ 
            '--title' => $data['title'],
            '--subtitle' => $data['subtitle'],
            '--subnews' => $data['subnews'],
            '--time' => $data['time'] ?? '',
            '--city' => $data['city'] ?? '',
            '--live' => $data['live'] ?? '',
            '--newsalert' => $data['newsalert'] ?? '',
            '--breakingnews' => $data['breakingnews'] ?? '',
            '--cover' => $data['cover'] ?? '',
            '--image_path' => $path,
        ]);

        // scale the image up
        $img = Image::make($path)->widen(1200)->save();

        // optimize the image
        ImageOptimizer::optimize($path);

        // if (! $request->expectsJson()) {
        //     return redirect()->route('home');
        // }

        // return a response
        return response(['success' => true, 'image_url' => $public_path], 200);
    }


    public function download(Request $request) 
    {
        $file = explode('/', $request->query('f'));

        $file = end($file);

        $storage_path = sprintf('%s/%s/%s/%s', storage_path('app/public/screenshots'), date('Y'), date('m'), $file);
        $public_path = sprintf('%s/screenshots/%s/%s/%s', config('app.url'), date('Y'), date('m'), $file);

        if (! file_exists($storage_path)) {
            abort(404);
        }

        // return response()->download($storage_path)->deleteFileAfterSend();
        return response()->download($storage_path);
    }
}
