@extends('layouts.app')
@section('content')


    <div class="title m-b-md">
        Video Viewers({{ $video->viewers }})
    </div>
<iframe width="560" height="315" src="https://www.youtube.com/embed/GVNDbTwOSiw?si=2tqE8ePcREuDT7Rz" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

@endsection