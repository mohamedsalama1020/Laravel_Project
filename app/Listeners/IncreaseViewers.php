<?php

namespace App\Listeners;

use App\Events\VideoViewers;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseViewers
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
    public function handle(VideoViewers $event): void
    {
        
        $video = $event->video;

        $sessionKey = 'viewed_video' .$video->id;

        if(!session()-> has($sessionKey)){

            $this->increase($event->video);
            session()->put($sessionKey,true);
        }

    }

    public function increase($video){

         $video -> viewers += 1;
         $video->save();

    }
}
