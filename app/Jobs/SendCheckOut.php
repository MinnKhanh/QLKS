<?php

namespace App\Jobs;

use App\Mail\SendMailCheckOut;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCheckOut implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $customer;
    public $listRoom;
    public $email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$customer, $listRoom)
    {
        $this->email=$email;
        $this->customer = $customer;
        $this->listRoom = $listRoom;
        $this->queue = 'send_checkout';
        // dd($customer);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new SendMailCheckOut($this->customer,$this->listRoom));
    }
}
