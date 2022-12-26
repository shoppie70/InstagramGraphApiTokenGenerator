<?php

namespace App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LogMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     */
    public array $result;
    public string $title;

    public function __construct(array $result)
    {
        $this->result = $result;
        $this->title = 'Error Occurred!';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->markdown('mail.log')
            ->subject($this->title)
            ->to(config('admin_email'))
            ->from('noreply@salvador79.dev')
            ->with([
                'title' => $this->title,
                'request' => $this->result,
            ]);
    }
}
