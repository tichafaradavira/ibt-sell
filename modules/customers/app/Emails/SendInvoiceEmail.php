<?php

namespace Modules\Customers\Emails;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use Modules\Customers\Models\Customer;
use Modules\Customers\Services\InvoiceService;
use Modules\Users\Models\User;

class  SendInvoiceEmail extends Mailable
{
    use SerializesModels;

    protected $invoice;
    protected $vendor;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $vendor, $invoice)
    {
        $this->vendor = $vendor;
        $this->invoice = $invoice;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $invoice_service = resolve(InvoiceService::class);
        $pdf = $invoice_service->generatePdfInvoice( $this->invoice);

        return $this->from($this->vendor->email)
            ->with([
                'invoice' => $this->invoice,
            ])
            ->attachData($pdf->stream(), 'invoice-'.$this->invoice->number.'.pdf', [
                'mime' => 'application/pdf',
            ])
            ->markdown('customers::emails.sendinvoice');
    }

}
