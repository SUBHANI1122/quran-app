<?php

namespace App\Schedule;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\SendDailyTopic;

class SendDailyTopicSchedule
{
    public function __invoke(Schedule $schedule): void
    {
        $schedule->command('send:daily-topic')->everyMinute();
    }
}
