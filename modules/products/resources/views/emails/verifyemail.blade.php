

@component('mail::message')

Dear- {{$user->first_name}}

Thank you for creating an account on IBT Vendor.
Please find below your One Time Password (expires in an hour):

{{$user->otp}}



Thanks,<br>
Ibt Team
@endcomponent
