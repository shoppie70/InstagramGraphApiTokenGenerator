<?php

namespace App\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ErrorLogMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     */
    public array $request;
    public string $message;
    public string $title;

    public function __construct(string $message, array $request)
    {
        $this->request = $request;
        $this->message = $message;
        $this->title = 'Error Occurred!';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        return $this->markdown('mail.error')
            ->subject($this->title)
            ->to(config('admin_email') ?? 'info@example.com')
            ->from('noreply@salvador79.dev')
            ->with([
                'title' => $this->title,
                'request' => $this->request,
                'message' => $this->message,
            ]);
    }
}
