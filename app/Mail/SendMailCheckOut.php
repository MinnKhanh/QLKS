<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailCheckOut extends Mailable
{
    use Queueable, SerializesModels;
    public $customer;
    public $lisRoom;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer, $lisRoom)
    {
        $this->customer=$customer;
        $this->lisRoom=$lisRoom;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('template.checkout')->with(['customer'=>$this->customer,'listRoom'=>$this->lisRoom]);
    }
}
