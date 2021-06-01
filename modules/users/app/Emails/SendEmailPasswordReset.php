<?php

namespace Modules\Users\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Users\Models\User;

class SendEmailPasswordReset extends Mailable
{
    use SerializesModels;

    protected $student;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $student)
    {
        $this->student = $student;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@ibttutor.com')
        ->with([
            'student' =>$this->student
        ])
        ->markdown('users::emails.student-forgot-password');
    }
}
