@extends('layouts.master')
@section('title','Thể loại truyện '.$genre->name.' | Đọc truyện '.$genre->name.' manga, manhwa, manhua online miễn phí')
@section('meta_des','Thể loại '. $genre->name.' | '.$genre->description)
@section('og_url',url()->current())
@section('content')
    <div class="container ">
        <nav class="white z-depth-0 nav-breadcrumb">
        <div class="nav-wrapper">
            <div class="col s12">
                <a href="/" class="breadcrumb grey-text"><i class="material-icons">home</i>Trang chủ</a>
                <a href="{{route('genre')}}" class="breadcrumb grey-text">Thể loại</a>
                <a href="{{route('genre',['genre'=>$genre->slug])}}" class=" breadcrumb grey-text active">{{$genre->name}}</a>
            </div>
        </div>
        </nav>
    </div>

    {{--</nav>--}}
    <div class="container ">
        <div class="section header-section-list padding-0">
            <div class="row">
                <div class="col s12">
                    <h1 class="no-margin title-h1-list grey-text darken-4">Thể loại truyện {{$genre->name}} miễn
                        phí</h1>
                </div>
                <div class="col s12 m8 offset-m2 l6 offset-l3">
                    <div class="card-panel z-depth-0 no-padding margin-0">
                        <div class="row valign-wrapper">
                            <div class="col s3">
                                <img src="{{asset('img/naruto.jpg')}}" alt="" class="circle responsive-img"> <!-- notice the "circle" class -->
                            </div>
                            <div class="col s9">
                <span class="black-text">
                  {!! $genre->description !!}
                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="section padding-0">
            <div class="card-panel padding-0">
                <div class="row">
                    @foreach($mangas as $item)
                        @include('manga.partial._manga')
                        @endforeach
                </div>
            </div>

            <div class="center">
                {!! $mangas->links() !!}
            </div>
        </div>
    </div><!-- container -->
    @endsection