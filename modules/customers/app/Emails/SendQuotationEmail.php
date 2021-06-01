<?php

namespace Modules\Customers\Emails;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Modules\Customers\Models\Customer;
use Modules\Customers\Services\QuotationService;
use Modules\Users\Models\User;

class  SendQuotationEmail extends Mailable
{
    use SerializesModels;

    protected $quotation;
    protected $vendor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $vendor, $quotation)
    {
        $this->vendor = $vendor;
        $this->quotation = $quotation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $quotation_service = resolve(QuotationService::class);
        $pdf = $quotation_service->generatePdfQuotation( $this->quotation);

        return $this->from($this->vendor->email)
            ->with([
                'quotation' => $this->quotation,
            ])
            ->attachData($pdf->stream(), 'quotation-'.$this->quotation->number.'.pdf', [
                'mime' => 'application/pdf',
            ])
            ->markdown('customers::emails.sendquotation');
    }

}
