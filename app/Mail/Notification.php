<?php

namespace App\Mail;

use App\Campaign;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Notification extends Mailable
{
    use Queueable, SerializesModels;
	public $campaign;
	public $backer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Campaign $campaign,User $backer)
    {
        $this->campaign = $campaign;
		$this->backer = $backer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.notification');
    }
}
