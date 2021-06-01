<?php

namespace Modules\Products\Emails;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Products\Models\User;

class  ActivateAccountEmail extends Mailable
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
        return $this->from('admin@ibttutor.com')
        ->with([
            'user' =>$this->user,
        ])
        ->markdown('users::emails.activateaccountemail');
    }
}
