<?php

namespace App\Components\GoogleCalendar;

use App\Events\GoogleCalendar\VacationEventsFetched;
use Carbon\Carbon;
use DateTime;
use Illuminate\Console\Command;
use Spatie\GoogleCalendar\Event;

class FetchVacationGoogleCalendarEvents extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'dashboard:vacation-calendar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Google Vacation Calendar events.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $calendarId = config('laravel-google-calendar.vacation_calendar_id');
        $events = collect(Event::get(null, null, [], $calendarId))
            ->filter(function (Event $event) {
                return true;
            })->map(function (Event $event) {
            return [
                'name' => $event->name,
                'date' => Carbon::createFromFormat('Y-m-d H:i:s', $event->getSortDate())->format(DateTime::ATOM),
            ];
        })
            //->unique('name')
            ->toArray();

        event(new VacationEventsFetched($events));
    }
}
