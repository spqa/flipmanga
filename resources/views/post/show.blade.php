@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="nav-wrapper ">
            <div class="col s12 scroll-breadcrumb">
                <a href="/" class="breadcrumb grey-text"><i class="material-icons">home</i>Trang chủ</a>

                <a href="/" class="breadcrumb grey-text active">fsdf</a>
            </div>
        </div>
        <div class="row">
            <div class="col l6 offset-l2 m8 s12 meme-section">
                @for($i=1;$i<10;$i++)
                    @include('meme._meme')
                    <div class="divider"></div>
                @endfor
            </div>
            <div class="col m4 l3 offset-l1 hide-on-small-only post-sidebar">
                @for($i=1;$i<10;$i++)
                    @include('post._post')
                    {{--<div class="divider"></div>--}}
                @endfor
            </div>
        </div>
@endsection