<?php

namespace App\Schedule;

use Illuminate\Console\Scheduling\Schedule;

class SendDailyTopicSchedule
{
    public function __invoke(Schedule $schedule): void
    {
        $schedule->command('send:daily-topic')->everyMinute();
    }
}
