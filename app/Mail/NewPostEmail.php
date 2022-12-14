<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPostEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $_new_post;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($new_post)
    {
        $this->_new_post = $new_post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            '_new_post' => $this->_new_post
        ];

        return $this->view('mails.new-post-email', $data);
    }
}
