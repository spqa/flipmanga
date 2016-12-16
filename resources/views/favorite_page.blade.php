@extends('layouts.master')
@section('content')
    <div class="container ">
        <nav class="white z-depth-0 nav-breadcrumb">
            <div class="nav-wrapper">
                <div class="col s12">
                    <a href="/" class="breadcrumb grey-text"><i class="material-icons">home</i>Home</a>
                    <a href="#!" class="breadcrumb grey-text">Favorites</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="container">

        <div class="row">
            <div class="col s12">
                <h2 class="no-margin title-h1-list grey-text darken-4">Favorites</h2>
            </div>
            @if(empty($mangas->first()))
                <h3 style="min-height: 300px" class="center grey-text text-lighten-3">Oops! Nothing here</h3>
                @endif
            @foreach($mangas as $item)
                @include('manga.partial._manga_suggestion')
            @endforeach


        </div>
    </div>
@endsection