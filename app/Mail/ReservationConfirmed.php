<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use PDF;
use Illuminate\Support\Facades\Storage;

class ReservationConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $reservations;
    public $pasageri;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reservations, $pasageri)
    {
        $this->reservations = $reservations;
        $this->pasageri = $pasageri;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Generate the PDF
        $pdf = PDF::loadView('pdf.reservation', [
            'reservations' => $this->reservations,
            'pasageri' => $this->pasageri,
        ])->setPaper('a4')
          ->setWarnings(false);

        // Store the PDF in storage
        $pdfPath = 'reservations/' . now()->format('Y-m-d_H-i-s') . '.pdf';
        Storage::put($pdfPath, $pdf->output());

        return $this->from('no-reply@example.com', 'ScorpanTur')
                    ->subject('Confirmare Rezervare')
                    ->view('emails.reservation_confirmed')
                    ->attachData($pdf->output(), 'reservation.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}
