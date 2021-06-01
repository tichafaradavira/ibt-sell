<?php

namespace Modules\Users\Emails;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Users\Models\User;

class  SuspendAccountEmail extends Mailable
{
    use SerializesModels;

    protected $user;
    protected $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $message)
    {
        $this->user = $user;
        $this->message = $message;
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
            'user' =>$this->user,
            'message' =>$this->message,
        ])
        ->markdown('users::emails.suspendaccountemail');
    }
}
