<?php

namespace App\Jobs;

use App\Models\Sale;
use App\Mail\DailySalesReport;
use App\Models\Seller;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendDailySalesReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        $today = Carbon::today();

        $sellers = Seller::whereHas('sales', function ($query) use ($today) {
            $query->whereDate('created_at', $today);
        })->get();

        foreach ($sellers as $seller) {
            $sales = Sale::where('seller_id', $seller->id)
                ->whereDate('created_at', $today)
                ->get();

            if ($sales->isNotEmpty()) {
                Mail::to($seller->email)->send(new DailySalesReport($seller, $sales));
            }
        }
    }
}
