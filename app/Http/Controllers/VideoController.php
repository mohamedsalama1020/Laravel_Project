<?php

namespace App\Http\Controllers;

use App\Events\VideoViewers;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{

    public function createVideo(){

        Video::create([
            'title'=>'first video',

        ]);

    }
    public function getVideo(){

        $video=Video::first();
        event(new VideoViewers($video));

        return view('video')->with('video',$video);

    }
}
