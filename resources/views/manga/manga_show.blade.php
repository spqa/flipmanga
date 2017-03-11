@extends('layouts.master')
@section('title',$manga->name.'('.$manga->alias.')'.' - Read '.$manga->name.' online for free')
@section('meta_des',e($manga->description))
@section('og_url',url()->current())
@section('image',$manga->poster)
@section('content')
    <!-- start content -->
    <div class="container ">
        <nav class="white z-depth-0 nav-breadcrumb">
        <div class="nav-wrapper">
            <div class="col s12">
                <a href="/" class="breadcrumb grey-text"><i class="material-icons">home</i>Trang chủ</a>
                @if(isset($main_genre))
                    <a href="{{route('genre',['genre'=>$main_genre->slug])}}" class="breadcrumb grey-text">{{$main_genre->name}}</a>

                @endif
                <a href="{{route('manga',['manga'=>$manga->slug])}}" class="breadcrumb grey-text active">{{$manga->name}}</a>
            </div>
        </div>
        </nav>
        <div class="section manga-show-header ">
            <div class="row z-depth-2">

                <div class="col s5 m3 l2">
                    <img class="materialboxed responsive-img" src="{{$manga->poster}}">
                </div>
                <div class="col s7 m9 l0">
                    <h1 class="inline title-h1-manga">{{$manga->name}} <small>Read free manga online</small></h1>
                    @if(!empty($manga->alias))
                        <h2 class="grey-text inline">({{$manga->alias}})</h2>
                        @endif
                    <p class="">Author: <a href="#" rel="author">{{$manga->author}}</a></p>
                    <p class="">Translator: <a href="#" rel="author">{{$manga->translator}}</a></p>
                    <p class="">Year of Release : {{empty($manga->released_at)?'N/A':$manga->released_at->toFormattedDateString()}}</p>
                    <p class=""> Status : {{$manga->status}}</p>
                    <p class=""> View : {{$manga->view}}</p>
                    <p class=""> <i class="material-icons red-text">favorite</i> : {{$manga->getFavorite()}}</p>

                    <div class="manga-show-button hide-on-small-only">
                        <a href="{{route('manga',['manga'=>$manga->slug,'chapter'=>$manga->chapters->where('chapter_number',$manga->chapters->min('chapter_number'))->first()->id])}}" class="waves-effect waves-light btn  pink darken-3">Chapter 1</a>
                        <a href="{{route('manga',['manga'=>$manga->slug,'chapter'=>$manga->chapters->where('chapter_number',$manga->chapters->max('chapter_number'))->first()->id])}}" class="waves-effect waves-light btn  pink darken-3">Last Chapter</a>
                        {{--<a class="waves-effect waves-light btn green darken-3">Continue Read</a>--}}
                        @if(isset($is_fav) && $is_fav==true)
                            <button class="waves-effect waves-light btn white black-text btn-favorite" data-id="{{$manga->id}}" ><i class="material-icons  red-text text-accent-4 left">favorite</i>Added to Favorites</button>
                        @else
                            <button class="waves-effect waves-light btn white black-text btn-favorite" data-id="{{$manga->id}}" ><i class="material-icons  red-text text-accent-4 left">favorite_border</i>Add to Favorites</button>
                        @endif
                    </div>
                </div>
                <div class="col s12">
                    <div class="manga-show-button-mobile hide-on-med-and-up">
                        <a href="{{route('manga',['manga'=>$manga->slug,'chapter'=>$manga->chapters->first()->id])}}" class="waves-effect waves-light btn   pink darken-3">Chapter 1</a>
                        <a href="{{route('manga',['manga'=>$manga->slug,'chapter'=>$manga->chapters->last()->id])}}" class="waves-effect waves-light btn   pink darken-3">Last Chapter</a>
                        {{--<a class="waves-effect waves-light btn">Continue Read</a>--}}
                        @if(isset($is_fav))
                            <button class="waves-effect waves-light btn white black-text btn-favorite" data-id="{{$manga->id}}" ><i class="material-icons  red-text text-accent-4 left">favorite</i>Added to Favorites</button>
                        @else
                            <button class="waves-effect waves-light btn white black-text btn-favorite" data-id="{{$manga->id}}" ><i class="material-icons  red-text text-accent-4 left">favorite_border</i>Add to Favorites</button>
                        @endif
                    </div>
                    <!-- <a class="col s4 padding-0">
                        dfsdf
                      </a>
                      <div class="col s4">
                        <a href="#" class="waves-effect waves-light btn padding-0">Last Chapter</a>
                      </div>
                      <div class="col s4">
                        <a class="waves-effect waves-light btn padding-0">Continue Read</a>
                      </div> -->

                    <!-- <a class="waves-effect waves-light btn">Last Chapter</a>
                    <a class="waves-effect waves-light btn">Continue Read</a>
                  </div> -->
                    <div class="manga-show-genre">
                        <a class="chip black-text grey lighten-3" href="/genre">Genres</a>
                        @foreach($manga->getCachedGenres() as $genre)
                            <a href="{{route('genre',['genre'=>$genre->slug])}}" class="chip white-text orange darken-4">{{$genre->name}}</a>
                        @endforeach
                    </div>
                    <p class="manga-description">{{ $manga->description }}</p>
                    <div class="hide">
                        <h3>Đọc truyện {{$manga->name}} miễn phí</h3>
                        <h3>Đọc truyện online {{$manga->name}} miễn phí</h3>
                        <h3>Đọc truyện tranh {{$manga->name}} miễn phí</h3>
                        <h3>Đọc truyện tranh {{$manga->name}} online</h3>
                        <h3>{{$manga->name}} đọc truyện tranh online</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="addthis_inline_share_toolbox_t23u"></div>

        <div class="section padding-0">
            <div class="row">
                <div class="col s12">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header active">Latest Update Chapters <i
                                        class="material-icons">send</i></div>
                            <div class="collapsible-body">
                                <div class="collection">
                                    @foreach($manga->chapters->sortByDesc('chapter_number')->take(5) as $chapter)
                                        <a href="{{route('manga',['manga'=>$manga->slug,'chapter'=>$chapter->id])}}"
                                           class="collection-item">{{$chapter->name}}
                                            {{--<span class="new badge red "></span>--}}
                                            <span class="secondary-content">{{$chapter->updated_at->diffForHumans()}}</span></a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="collapsible-header">Chapter List <i class="material-icons">send</i></div>
                            <div class="collapsible-body">
                                <div class="collection">
                                    {{--<div class="collection-item">--}}
                                        {{--<ul class="pagination center">--}}
                                            {{--<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a>--}}
                                            {{--</li>--}}
                                            {{--<li class="active"><a href="#!">1</a></li>--}}
                                            {{--<li class="waves-effect"><a href="#!">2</a></li>--}}
                                            {{--<li class="waves-effect"><a href="#!">3</a></li>--}}
                                            {{--<li class="waves-effect"><a href="#!">4</a></li>--}}
                                            {{--<li class="waves-effect"><a href="#!">5</a></li>--}}
                                            {{--<li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                    @foreach($manga->chapters->sortBy('chapter_number') as $chapter)
                                        <a href="{{route('manga',['manga'=>$manga->slug,'chapter'=>$chapter->id])}}"
                                           class="collection-item">{{$chapter->name}}<span
                                                    class="secondary-content">{{$chapter->created_at->toFormattedDateString()}}</span></a>
                                    @endforeach
                                    {{--<div class="collection-item center">--}}
                                        {{--<ul class="pagination ">--}}
                                            {{--<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a>--}}
                                            {{--</li>--}}
                                            {{--<li class="active"><a href="#!">1</a></li>--}}
                                            {{--<li class="waves-effect"><a href="#!">2</a></li>--}}
                                            {{--<li class="waves-effect"><a href="#!">3</a></li>--}}
                                            {{--<li class="waves-effect"><a href="#!">4</a></li>--}}
                                            {{--<li class="waves-effect"><a href="#!">5</a></li>--}}
                                            {{--<li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a>--}}
                                            {{--</li>--}}
                                        {{--</ul>--}}
                                        {{--<span>Go to page:</span>--}}
                                        {{--<input name="page" type="number" class="go-to-page">--}}
                                    {{--</div>--}}
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="row you-may-also-like">
                <div class="col s12">
                    <h4 class="grey-text">Mangas you may also like</h4>
                </div>
                @foreach($suggestion as $item)
                    @include('manga.partial._manga_suggestion')
                @endforeach
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="chip">Tags</div>
                    <h4 class="chip indigo darken-1"><a rel="tag" class="white-text" href="{{route('manga.latest')}}">latest manga</a></h4>
                    <h4 class="chip indigo darken-1"><a rel="tag" class="white-text" href="{{route('manhwa.latest')}}">latest manhwa</a></h4>
                    <h4 class="chip indigo darken-1"><a rel="tag" class="white-text" href="{{route('manhua.latest')}}">latest manhua</a></h4>
                    <h4 class="chip indigo darken-1"><a rel="tag" class="white-text" href="{{route('genre',['genre'=>'adult'])}}">adult manga</a></h4>
                </div>
            </div>
        </div>

        {{--adult modal--}}
        @foreach($manga->getCachedGenres() as $genre)
            @if($genre->name=='Adult')
        <div id="adult-modal" class="modal">
            <div class="modal-content">
                <h4><i class="material-icons red-text medium">warning</i>Caution to under-aged viewers</h4>
                <p>The series {{$manga->name}} contain themes or scenes that may not be suitable for very young readers thus is blocked for their protection.</p>
            </div>
            <div class="modal-footer">
                <a href="#!" id="adult-continue" class=" modal-action modal-close waves-effect waves-green btn-flat">i am above 18, continue</a>
                <a href="/" class=" modal-action modal-close waves-effect waves-green btn-flat">Take me back</a>
            </div>
        </div>
                @break
            @endif
        @endforeach
        <div class="fb-comments" data-width="100%" data-href="{{url()->current()}}" data-numposts="5"></div>
        {{--<div id="disqus_thread"></div>--}}
        {{--<script>--}}

            {{--/**--}}
             {{--*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.--}}
             {{--*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/--}}
            {{--/*--}}
             {{--var disqus_config = function () {--}}
             {{--this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable--}}
             {{--this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable--}}
             {{--};--}}
             {{--*/--}}
            {{--(function () { // DON'T EDIT BELOW THIS LINE--}}
                {{--var d = document, s = d.createElement('script');--}}
                {{--s.src = 'http://kmanga-me.disqus.com/embed.js';--}}
                {{--s.setAttribute('data-timestamp', +new Date());--}}
                {{--(d.head || d.body).appendChild(s);--}}
            {{--})();--}}
        {{--</script>--}}
        {{--<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by--}}
                {{--Disqus.</a></noscript>--}}

    </div><!-- container -->
    <!-- end content -->
@endsection

@section('page_script')
    <script src="{{asset('/js/mangashow.js')}}"></script>
    @endsection