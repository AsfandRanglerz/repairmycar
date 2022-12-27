<?php

namespace App\Jobs;

use Mail;
use Carbon\Carbon;
use App\Models\Garage;
use App\Models\Vendor;
use App\Models\UserWishlist;
use Illuminate\Bus\Queueable;
use App\Models\webNotification;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNotification implements ShouldQueue
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
        if ($this->message['type'] == "all_garage") {
            if ($this->message['qoute_range'] == '5') {
                $garage = Garage::with('vendor')->orderBy('rating', 'desc')->limit(5)->get();
            } elseif ($this->message['qoute_range'] == '10') {
                $garage = Garage::with('vendor')->orderBy('rating', 'desc')->limit(10)->get();
            } else {
                $garage = Garage::with('vendor')->get();
            }
            foreach ($garage as $data) {

                $gettime = strtotime($data->vendor->online_status) + 10;
                $now = strtotime(Carbon::now());
                if ($now > $gettime) {
                    $email = new \App\Mail\SendNotification($this->message);
                    Mail::to($data->vendor->email)->send($email);
                } else {
                    $notification = new webNotification();
                    $notification->vendor_id = $data->vendor->id;
                    $notification->title = $this->message['body1'] . " Quotation placed against you and other vendors";
                    $notification->links = $this->message['link1'];
                    $notification->body = ' ';
                    $notification->save();
                }
            }
        }

        if ($this->message['type'] == "preferred_garage") {

            $id = $this->message['auth'];
            $garageIds = [];
            $data = UserWishlist::where('user_id', $id)->with('garage')->get();
            foreach ($data as $list_item) {
                array_push($garageIds, $list_item->garage->id);
            }
            if ($this->message['qoute_range'] == '5') {
                $garage = Garage::with('vendor')->whereIn('id', $garageIds)->orderBy('rating', 'desc')->limit(5)->get();
            } elseif ($this->message['qoute_range'] == '10') {

                $garage = Garage::with('vendor')->whereIn('id', $garageIds)->orderBy('rating', 'desc')->limit(10)->get();
            } else {
                $garage = Garage::with('vendor')->whereIn('id', $garageIds)->get();
            }
            foreach ($garage as $data) {

                $gettime = strtotime($data->vendor->online_status) + 10;
                $now = strtotime(Carbon::now());
                if ($now > $gettime) {
                    $email = new \App\Mail\SendNotification($this->message);
                    Mail::to($data->vendor->email)->send($email);
                } else {
                    $notification = new webNotification();
                    $notification->vendor_id = $data->vendor->id;
                    $notification->title = $this->message['body1'] . " Quotation placed against you and other preferred vendors";
                    $notification->links = $this->message['link1'];
                    $notification->body = ' ';
                    $notification->save();
                }
            }
        }
    }
}
