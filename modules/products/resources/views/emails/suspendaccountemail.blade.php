@component('mail::message')
Dear- {{$user->first_name}}

Your account has been suspended for :

<b>
{{$message}}
<b>
For for more information please contact : admin@ibttutor.com

Thanks,<br>
Ibt Team
@endcomponent
