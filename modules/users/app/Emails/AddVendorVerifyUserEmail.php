<?php

namespace Modules\Users\Emails;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Modules\Users\Models\User;

class  AddVendorVerifyUserEmail extends Mailable
{
    use SerializesModels;

    protected $user;
    protected $temporary_password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $temporary_password)
    {
        $this->user = $user;
        $this->temporary_password = $temporary_password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@ibtvendor.com')
        ->with([
            'user' =>$this->user,
            'temporary_password' => $this->temporary_password
        ])
        ->markdown('users::emails.addvendoremail');
    }
}
