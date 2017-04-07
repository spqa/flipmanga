@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col l6 offset-l2 m8 s12 meme-section">
                @each('meme._meme',$memes,'meme')
            </div>
            <div class="col m4 l3 offset-l1 hide-on-small-only post-sidebar">
                {{--@for($i=1;$i<10;$i++)--}}
                    {{--@include('post._post')--}}
                    {{--<div class="divider"></div>--}}
                {{--@endfor--}}
            </div>
        </div>

    </div>
    @endsection