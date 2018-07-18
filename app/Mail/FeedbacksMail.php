<?php

namespace App\Mail;

use App\Model\Feedbacks;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FeedbacksMail extends Mailable
{
    use Queueable, SerializesModels;

    public $feedbacks;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Feedbacks $feedbacks)
    {
        $this->feedbacks = $feedbacks;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('qinyi7577@163.com')
            ->subject('all.singiblog.top有新的反馈建议')
            ->view('mail.feedback');
    }
}
