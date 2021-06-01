<?php

namespace Modules\Users\Emails;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Users\Models\User;

class SendEmailVerifyUserEmail extends Mailable
{
    use SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@realtorparc.com')
        ->with([
            'user' =>$this->user,
        ])
        ->markdown('users::emails.verifyemail');
    }
}
