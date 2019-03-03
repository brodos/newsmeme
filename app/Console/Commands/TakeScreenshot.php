<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class TakeScreenshot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'screenshot:take 
                                    {--title= : the news title} 
                                    {--subtitle= : the news subtitle} 
                                    {--subnews= : the sub news} 
                                    {--time= : the time to be displayed}
                                    {--city= : the city to be displayed}
                                    {--live= : is it live?} 
                                    {--breakingnews= : is it breaking news?} 
                                    {--newsalert= : is it news alert?} 
                                    {--cover= : cover for the news}
                                    {--image_path= : where to save the image}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Take a news screenshot';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        // fetch and prepare data
        $data = [
            'title' => $this->option('title'),
            'subtitle' => $this->option('subtitle'),
            'subnews' => $this->option('subnews'),
            'time' => $this->option('time') ?? '',
            'city' => $this->option('city') ?? '',
            'live' => $this->option('live') ?? '',
            'breakingnews' => $this->option('breakingnews') ?? '',
            'newsalert' => $this->option('newsalert') ?? '',
            'cover' => $this->option('cover') ?? '',
        ];

        // build the screenshot path
        $path = $this->option('image_path');
        $screenshot = '--screenshot=' . $path;

        // build the url
        $url = route('screenshot') . '?' . http_build_query($data);

        // take the screenshot
        $process = new Process([
            env('GOOGLE_CHROME_PATH', 'google-chrome'), 
            '--no-sandbox', 
            '--headless', 
            '--disable-gpu', 
            '--hide-scrollbars', 
            '--window-size=800,450', 
            // '--virtual-time-budget=3000', 
            $screenshot,
            $url,
    	]);

        // get live updates
        $process->run();
	    // $process->run(function ($type, $buffer) {
    	//     if (Process::ERR === $type) {
     //            echo 'ERR > ' . $type . ': ' . $buffer . "\r\n";
     //        } else {
     //            echo 'OUT > ' .  $type . ': ' . $buffer . "\r\n";
    	//     }
	    // });

        // handle process syncronous
	    $process->wait();

        // executes after the command finishes
        if (! $process->isSuccessful()) {
            $this->error('Screeshot was not taken');
            throw new ProcessFailedException($process);
        }

        // cleanup
	    $process->clearOutput();

        // set the right permission for the file
	    $process = new Process(['chmod', '0660', $path]);
	    $process->run();

        if (! $process->isSuccessful()) {
            $this->error('Could not set the right permission to the file.');
            throw new ProcessFailedException($process);
        }

        // cleanup
	    $process->clearOutput();

        // finish
        $this->info('Screenshot path: ' . $path);
    }    
}
