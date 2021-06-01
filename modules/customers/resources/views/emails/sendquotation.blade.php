@component('mail::message')
Dear- {{$quotation->customer ? $quotation->customer->full_name :$quotation->lead->full_name}}

Please find attached your quotation

Thanks,<br>
Ibt Team
@endcomponent
