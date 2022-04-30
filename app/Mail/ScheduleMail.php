<?php

namespace App\Mail;

// use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ScheduleMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The order instance.
     *
     * @var \App\Models\Schedule
     */
    public $schedules;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($schedules)
    {
        $this->schedules = $schedules;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('emails.schedule');
        return $this->view('emails.schedule')->text('emails.schedule_plain');
    }
}
