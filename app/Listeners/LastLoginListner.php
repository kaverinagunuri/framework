<?php

namespace App\Listeners;
use Event;
use App\Events\LastLogin;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LastLoginListner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LastLogin  $event
     * @return void
     */
    public function handle(LastLogin $event)
    {
        $Id=$event->details;
    
        \App\User::where('Id',$Id)->update(['Last_Login'=>Carbon::now()]);
       
    }
}
