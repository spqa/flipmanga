@extends('layouts.master')
@section('content')
    <!-- start content -->
    <div class="container ">
        <div class="section manga-show-header">
            <div class="row z-depth-2">
                <div class="col s5 m3 l2">
                    <img class="materialboxed responsive-img" src="{{$manga->poster}}">
                </div>
                <div class="col s7 m9 l0">
                    <h2 class="inline">{{$manga->name}}</h2>
                    @if(!empty($manga->alias))
                        <h2 class="grey-text inline">({{$manga->alias}})</h2>
                        @endif
                    <p class="">Author: <a href="#" rel="author">{{$manga->author}}</a></p>
                    <p class="">Translator: <a href="#" rel="author">{{$manga->translator}}</a></p>
                    <p class="">Year of Release : {{empty($manga->released_at)?'N/A':$manga->released_at->toFormattedDateString()}}</p>
                    <p class=""> Status : {{$manga->status}}</p>
                    <span>Genres: <div class="chip small-tag">harem</div><div class="chip small-tag">romance</div><div
                                class="chip small-tag">ecchi</div><div class="chip small-tag">hen</div></span>
                    <div class="manga-show-button hide-on-small-only">
                        <a href="{{route('manga',['manga'=>$manga->slug,'chapter'=>$manga->chapters->first()->id])}}" class="waves-effect waves-light btn green darken-3">Chapter 1</a>
                        <a href="{{route('manga',['manga'=>$manga->slug,'chapter'=>$manga->chapters->last()->id])}}" class="waves-effect waves-light btn green darken-3">Last Chapter</a>
                        <a class="waves-effect waves-light btn green darken-3">Continue Read</a>
                    </div>
                </div>
                <div class="col s12">
                    <div class="manga-show-button-mobile hide-on-med-and-up">
                        <a href="{{route('manga',['manga'=>$manga->slug,'chapter'=>$manga->chapters->first()->id])}}" class="waves-effect waves-light btn">Chapter 1</a>
                        <a href="{{route('manga',['manga'=>$manga->slug,'chapter'=>$manga->chapters->last()->id])}}" class="waves-effect waves-light btn">Last Chapter</a>
                        <a class="waves-effect waves-light btn">Continue Read</a>
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
                    <p class="manga-description">{!! $manga->description !!}</p>
                </div>
            </div>
        </div>
        <div class="section padding-0">
            <div class="row">
                <div class="col s12">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li>
                            <div class="collapsible-header active">Latest Update Chapters <i
                                        class="material-icons">send</i></div>
                            <div class="collapsible-body">
                                <div class="collection">
                                    @foreach($manga->chapters->sortBy('id')->take(5) as $chapter)
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
                                    @foreach($manga->chapters->sortByDesc('id') as $chapter)
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
                    <h4 class="grey-text">You may also like</h4>
                </div>
                @foreach($suggestion as $item)
                    @include('manga.partial._manga_suggestion')
                @endforeach
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="chip">Tags</div>
                    <h4 class="chip indigo darken-1"><a class="white-text" href="">Romance</a></h4>
                    <h4 class="chip indigo darken-1"><a class="white-text" href="">school</a></h4>
                    <h4 class="chip indigo darken-1"><a class="white-text" href="">triangle</a></h4>
                    <h4 class="chip indigo darken-1"><a class="white-text" href="">threesome</a></h4>
                </div>
            </div>
        </div>
        <div id="disqus_thread"></div>
        <script>

            /**
             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
            /*
             var disqus_config = function () {
             this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
             this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
             };
             */
            (function () { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');
                s.src = 'http://kmanga-me.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by
                Disqus.</a></noscript>

    </div><!-- container -->
    <!-- end content -->
@endsection