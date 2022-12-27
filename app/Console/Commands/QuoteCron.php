<?php

namespace App\Console\Commands;

use Log;
use Carbon\Carbon;
use App\Models\UserBid;
use App\Jobs\ExpireQuote;
use Illuminate\Console\Command;

class QuoteCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'quote:cron';

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
        
        $date = Carbon::now()->subDays(7);
        $Quotes = UserBid::where([['created_at', '<', $date],['offer_status','pending']])->get();
        foreach ($Quotes as $quote) {
            $quote->delete();
        }
    }
}
