<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\AboutOrder;
use Mail;

class Notification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $message;
    public function __construct($message)
    {
        //
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        if($this->message['type']=="order"){

            // $notificaton = new \App\Mail\AboutOrder;
            Mail::to($this->message['email'])->send(new AboutOrder($this->message));
        }
        elseif($this->message['type']=="quote"){
            
            Mail::to($this->message['email'])->send(new \App\Mail\QuoteRespons($this->message));
        }
        else{

            Mail::to($this->message['email'])->send(new \App\Mail\Notification($this->message));
        }
      
    }
}
