<?php

namespace Tests\Feature;

use App\Jobs\SendDailySalesReport;
use App\Mail\DailySalesReport;
use App\Models\Sale;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class DailySalesReportEmailTest extends TestCase
{
    use RefreshDatabase;

    public function test_daily_sales_report_email_is_sent()
    {
        Mail::fake();

        $seller = Seller::factory()->create();
        Sale::factory()->withSeller($seller->id)->create();

        (new SendDailySalesReport())->handle();

        Mail::assertSent(DailySalesReport::class, function ($mail) use ($seller) {
            return $mail->hasTo($seller->email);
        });
    }
}
