<?php

namespace App\Mail;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SiteSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
         $this->data = $data;
    }


    public function build()
    {
        // $logo = SiteSetting::get();
        $data = $this->data;
        $order = Order::with('division', 'district', 'upazila', 'user')->where('id', $data['order_id_one'])->first();
        $orderItem = OrderItem::with('product')->where('order_id', $data['order_id_one'] )->orderBy('id', 'DESC')->get();
        $site_setting = SiteSetting::first();
        return $this->from('ekotamartbd@gmail.com')->view('mail.order_mail', compact('data','order','orderItem','site_setting'))->subject('Email From Ekota-Mart Shop');
    }



    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Ekota-Mart Order Mail',
        );
    }

    // /**
    //  * Get the message content definition.
    //  *
    //  * @return \Illuminate\Mail\Mailables\Content
    //  */
    // public function content()
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        // return [
        //     Attachment::fromData(fn() => $this->data['pdf']->output(),'Report.pdf')->withMime('application/pdf'),
        // ];

        if (isset($this->data['pdf'])) {
            return [
                Attachment::fromData(fn() => $this->data['pdf']->output(), 'Invoice.pdf')->withMime('application/pdf'),
            ];
        } else {
            return []; // Return an empty array or handle the case where 'pdf' is not defined.
        }
    }
}
