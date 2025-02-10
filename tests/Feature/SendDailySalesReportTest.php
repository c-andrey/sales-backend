<?php

namespace Tests\Feature;

use App\Jobs\SendDailySalesReport;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Schedule;
use Tests\TestCase;

class SendDailySalesReportTest extends TestCase
{
    use RefreshDatabase;

    public function test_daily_sales_report_job_is_dispatched()
    {
        Bus::fake();

        Schedule::job(SendDailySalesReport::class);

        $this->artisan('schedule:run');

        Bus::assertDispatched(SendDailySalesReport::class);
    }
}
