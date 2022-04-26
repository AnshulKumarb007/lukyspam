<?php

namespace App\Listeners;

use App\Events\SendOtp;
use App\Services\SMS\Msg91;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOtpListner implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendOtp  $event
     * @return void
     */
    public function handle(SendOtp $event)
    {
        $dlt_id=$this->get_dlt_id();
        Msg91::send($event->mobile,$event->message, $dlt_id);
    }


    private function get_dlt_id(){
        return env('OTP_DLT_ID');
    }
}
