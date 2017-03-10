@extends('layouts.master')
@section('content')
    <div class="container">
        <nav class="white z-depth-0 nav-breadcrumb">
            <div class="nav-wrapper">
                <div class="col s12">
                    <a href="/" class="breadcrumb grey-text"><i class="material-icons">home</i>Trang chủ</a>
                    <a href="/genre" class="breadcrumb grey-text active">Tìm kiếm thể loại</a>
                </div>
            </div>
        </nav>
        <div class="section">
            <div class="row">
                <div class="col s12">
                    <h1 class="title-h1-list">Lọc thể loại</h1>
                </div>
                <div class="col s12">
                    <div class="card-panel z-depth-0">
                        <div class="row">
                            @foreach($genres as $genre)
                                    <div class="chip " data-id="{{$genre->id}}">
                                        <img src="img/naruto.jpg" alt="Contact Person">
                                        {{$genre->name}}
                                    </div>

                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col s12 center">
                    <button class="btn red" id="btn-search-genre"><i class="material-icons">search</i></button>
                </div>

                <div class="col s12">
                    <div class="card-panel no-padding z-depth-0">
                        <div class="row">
                            @foreach($mangas as $item)
                                @include('manga.partial._manga_suggestion')
                                @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
@section('page_script')
    <script src="{{asset('js/genres.js')}}"></script>
    @endsection