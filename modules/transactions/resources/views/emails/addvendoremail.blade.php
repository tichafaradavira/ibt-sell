

@component('mail::message')

Dear- {{$user->first_name}}

An account  been created for you :
email : {{$user->email}}
password : {{$temporary_password}}

@component('mail::button', ['url' =>url("/user/email/verify/{$user->id}")])
Verify Email
@endcomponent


Thanks,<br>
Ibt Team
@endcomponent
