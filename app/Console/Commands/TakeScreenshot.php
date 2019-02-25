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
                                    {--cover= : cover for the news}';

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
        $path = storage_path('app/public/screenshots/' . md5(time()) . '.png');
        $screenshot = '--screenshot=' . $path;

        // build the url
        $url = route('screenshot') . '?' . http_build_query($data);


        $process = new Process([
            env('GOOGLE_CHROME_PATH', 'google-chrome'), 
            '--no-sandbox', 
            '--headless', 
            '--disable-gpu', 
            '--hide-scrollbars', 
            '--window-size=800,450', 
            '--virtual-time-budget=3000', 
	    $screenshot,
	    $url,
    	]);


	$process->run(function ($type, $buffer) {
    		if (Process::ERR === $type) {
        		echo 'ERR > '.$buffer;
    		} else {
        		echo 'OUT > '.$buffer;
    		}
	});

	$process->wait();
	$process->clearOutput();

	$process = new Process(['chmod', '0660', $path]);
	$process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            $this->error('Screeshot was not taken');
            throw new ProcessFailedException($process);
	}

	$process->clearOutput();


        $this->info($process->getOutput());
        $this->info('Screenshot path: ' . $path);
    }    
}
