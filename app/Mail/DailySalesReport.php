<?php

namespace App\Mail;

use App\Models\Seller;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailySalesReport extends Mailable
{
    use Queueable, SerializesModels;

    public $seller;
    public $sales;

    public function __construct(Seller $seller, $sales)
    {
        $this->seller = $seller;
        $this->sales = $sales;
    }

    public function build()
    {
        return $this->subject('Relatório Diário de Vendas')
            ->view('emails.daily_sales_report')
            ->with([
                'seller' => $this->seller,
                'sales' => $this->sales,
            ]);
    }
}
