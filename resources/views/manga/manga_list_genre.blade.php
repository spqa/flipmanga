@extends('layouts.master')
@section('title',$genre->name.' | Read free '.$genre->name.' manga, manhwa, manhua online for free')
@section('meta_des',$genre->name.' manga | '.$genre->description)
@section('og_url',url()->current())
@section('content')
    <div class="container ">
        <nav class="white z-depth-0 nav-breadcrumb">
        <div class="nav-wrapper">
            <div class="col s12">
                <a href="/" class="breadcrumb grey-text"><i class="material-icons">home</i>Home</a>
                <a href="{{route('genre')}}" class="breadcrumb grey-text">Genres</a>
                <a href="{{route('genre',['genre'=>$genre->slug])}}" class="breadcrumb grey-text active">{{$genre->name}}</a>
            </div>
        </div>
        </nav>
    </div>

    {{--</nav>--}}
    <div class="container ">
        <div class="section header-section-list padding-0">
            <div class="row">
                <div class="col s12">
                    <h1 class="no-margin title-h1-list grey-text darken-4">{{$genre->name}} Manga</h1>
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