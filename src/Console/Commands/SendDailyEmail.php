<?php

namespace Kwreach\Ads\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Kwreach\Ads\Events\SendMail;
use Kwreach\Ads\Models\Ads;

class SendDailyEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Daily Email At 8:00 PM To Advertisers Who Assigned To An Upcoming Ad';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        $upcoming_ads = Ads::whereDate('start_date', Carbon::tomorrow())->get();
        if (!empty($upcoming_ads)) {
            foreach ($upcoming_ads as $ad) {
                $advertiser = $ad->advertiser()->first();
                event(new SendMail($advertiser, $ad));
            }
        }
    }
}
