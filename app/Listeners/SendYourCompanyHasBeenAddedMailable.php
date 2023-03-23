<?php

namespace App\Listeners;

use App\Events\CompanyCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\YourCompanyHasBeenAdded;
use Illuminate\Support\Facades\Mail;

class SendYourCompanyHasBeenAddedMailable
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CompanyCreated $event): void
    {
        // send the mailable
        Mail::to($event->company->email)->send(new YourCompanyHasBeenAdded($event->company));
    }
}
