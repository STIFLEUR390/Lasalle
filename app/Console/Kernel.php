<?php

namespace App\Console;

use Carbon\Carbon;
use App\Mail\ScheduleMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Schedule as ModelSchedule;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $schedules = ModelSchedule::with(['teacher', 'faculty', 'room', 'course'])
                ->where('date', Carbon::now()->format('Y-m-d'))
                ->where('status', 'absent')
                ->orderBy('date', 'desc')->orderBy('start_time', 'asc')->get();


            $emails = [
                // 'taylor@example.com', 'dries@example.com'
                'heroldtamko39@gmail.com', "heroldfrancktamto@gmail.com"
            ];
            foreach ($emails as $email) {
                Mail::to($email)->send(new ScheduleMail($schedules));
            }
        // })->dailyAt('23:00');
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
