

@component('mail::message')

Dear- {{$user->first_name}}

This is an email to help you with password recovery.
Please find below your One Time Password (expires in an hour):

{{$user->otp}}

Thanks,<br>
Ibt Team
@endcomponent
