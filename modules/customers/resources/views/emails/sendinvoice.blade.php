@component('mail::message')
Dear- {{$invoice->customer->full_name}}

Please find attached your invoice

Thanks,<br>
Ibt Team
@endcomponent
