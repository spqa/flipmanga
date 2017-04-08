@extends('layouts.master')
@section('content')
    <div class="container">
        <nav class="white z-depth-0 nav-breadcrumb">
            <div class="nav-wrapper ">
                <div class="col s12 scroll-breadcrumb">
                    <a href="/" class="breadcrumb grey-text"><i class="material-icons">home</i>Trang chủ</a>
                    <a href="{{route('meme.index')}}" class="breadcrumb grey-text"> Ảnh chế | Meme </a>
                    <a href="{{route('meme.index',['slug'=>$meme->slug])}}" class="breadcrumb grey-text active">{{$meme->title}}</a>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col l8 m8 s12 meme-section">
                <h2>{{$meme->title}}</h2>
                <span class="btn grey-text transparent z-depth-0 no-padding"><i class="material-icons left">remove_red_eye</i><span>{{$meme->view_count}}</span></span>
                <span class="btn grey-text transparent z-depth-0 "><i class="material-icons left">comment</i><div class="fb-comments-count inline" data-href="/meme-anh-che/{{$meme->slug}}">0</div></span>
                <span class="btn grey-text transparent z-depth-0 right hide-on-small-only"><i class="material-icons left">access_time</i><span>{{$meme->created_at->diffForHumans()}}</span></span>
                <div class="fb-like" data-href="/" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                <div class="card z-depth-0 transparent center">
                    <img src="{{$meme->image}}">
                </div>
                <div id="comment">
                    <div class="fb-comments" data-width="100%" data-href="{{url()->current()}}" data-numposts="5"></div>
                </div>
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