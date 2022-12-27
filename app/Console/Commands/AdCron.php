<?php

namespace App\Console\Commands;

use Log;
use Carbon\Carbon;
use App\Models\SimpleAd;
use Illuminate\Console\Command;

class AdCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ad:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now();
        $ads = SimpleAd::where('validity','<', $date)->get();
        foreach($ads as $ad){
            $ad->delete();
            Log::info("Published Ad has been ended!");
        }
    }
}
