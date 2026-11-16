<?php

namespace App\Console;

use App\Enums\GroupUserStatusEnum;
use App\Enums\TicketStatusEnum;
use App\Events\OneDayLeftEvent;
use App\Events\UnreadTicketEvent;
use App\Models\Group;
use App\Models\Ticket;
use App\Services\TestCheckout;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(fn () => app(TestCheckout::class)->sweepExpired())
            ->everyMinute()->when(fn () => app(TestCheckout::class)->available())
            ->description('Expire synthetic checkout holds');
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            Ticket::where('status', '=', TicketStatusEnum::pending)->each(function ($item) {
                UnreadTicketEvent::dispatch($item);
            });
        })->everySixHours()->description('Unread Ticket Event SixHour');

        $schedule->call(function () {
            Group::where('status', '=', GroupUserStatusEnum::completed)->each(function ($item){
                if ($item->start_date->diffInDays(Carbon::now()) === 0) {
                    OneDayLeftEvent::dispatch($item);
                }
            });
        })->everyMinute()->description('One day left Tour');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
