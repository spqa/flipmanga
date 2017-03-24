@extends('layouts.master')
@section('content')
    <div class="container-fluid grey lighten-4">
    <!-- start content -->
    <div class="container-fluid  grey darken-4">
        <div class="card-panel transparent z-depth-0">
            <div class="row">
                <div class="col s12 ">
                    <h2 class="left title-h2 white-text">Truyện Hot Mới Cập Nhật</h2>
                    <button data-role="slide-next-1" class="btn right grey slide-navi hide-on-small-only"><i
                                class=" material-icons medium white-text">keyboard_arrow_right</i></button>
                    <button data-role="slide-prev-1" class="hide-on-small-only btn right grey slide-navi"><i
                                class=" material-icons medium white-text">keyboard_arrow_left</i></button>
                </div>
                <div class="col s12 m12 l12 ">

                    <div class="slide-container slide-1">
                        @each('manga.partial._manga_slider', $latestHotUpdate, 'item')
                    </div><!-- slide-container -->
                </div><!-- col-s12 -->
            </div>
        </div>
    </div>
    <div class="container ">
        <div class="row hide-on-med-and-up margin-0">
            <div class="col s12 center">
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox_vmgx"></div>
            </div>
        </div>
        <div class="row">
            <div class="col l9 s12 m12">
                <div class="card-panel transparent no-padding z-depth-0">

                    <div class="row">
                        <div class="in-progress-section">
                            <div class="col s12">
                                <h2 class="left title-h2 brown-text darken-4">Truyện đang đọc</h2>
                            </div>
                        </div>

                    </div><!-- row -->
                    <!-- </div> -->
                    <!-- section -->
                    <div class="row hide-on-small-only">
                        <div class="col s12">
                            <h2 class="left title-h2 brown-text darken-4">Truyện mới ra</h2>
                            <button data-role="slide-next-2" class="btn right blue-grey darken-3 slide-navi"><i
                                        class="material-icons medium grey-text">keyboard_arrow_right</i></button>
                            <button data-role="slide-prev-2" class="btn right blue-grey darken-3 slide-navi"><i
                                        class="material-icons medium grey-text">keyboard_arrow_left</i></button>
                        </div>
                        <div class="col s12 m12 l12">

                            <div class="slide-container slide-2">
                                @each('manga.partial._manga_slider', $newRelease, 'item')

                                {{--@foreach($newRelease as $item)--}}
                                {{--@include('manga.partial._manga_slider')--}}
                                {{--@endforeach--}}
                            </div><!-- slide-container -->


                        </div><!-- col-s12 -->
                    </div><!-- row -->
                    <!-- </div> -->
                    <!-- </div> -->
                    <div class="row hide-on-small-only">
                        <div class="col s12">
                            <h2 class="left title-h2 brown-text darken-4">Truyện đang hot</h2>
                            <button data-role="slide-next-3" class="btn right blue-grey darken-3 slide-navi"><i
                                        class="material-icons medium grey-text">keyboard_arrow_right</i></button>
                            <button data-role="slide-prev-3" class="btn right blue-grey darken-3 slide-navi"><i
                                        class="material-icons medium grey-text">keyboard_arrow_left</i></button>
                        </div>
                        <div class="col s12 m12 l12">

                            <div class="slide-container slide-3">
                                @each('manga.partial._manga_slider', $recommend, 'item')
                                {{--@foreach($recommend as $item)--}}
                                {{--@include('manga.partial._manga_slider')--}}
                                {{--@endforeach--}}
                            </div><!-- slide-container -->


                        </div><!-- col-s12 -->
                    </div><!-- row -->
                </div>
            </div>
            <div class="col hide-on-med-and-down l3 sidebar">
                {{--<div class="card transparent">--}}
                    {{--<div class="card-image">--}}
                        {{--<img class="poster-home-1" src="/img/doc-truyen-tranh-online-mien-phi.jpg"--}}
                             {{--alt="Website đọc truyện tranh online miễn phí tốt nhất Việt Nam"/>--}}
                        {{--<span class="card-title">Truyentranh18</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
                <div class="card-panel center hide">
                    <h1 class="title-h1">Truyentranh18 - Website đọc truyện tranh online miễn phí, đọc truyện tranh
                        manga tổng hợp</h1>
                    <p>Trang truyện tranh online miễn phí, truyện tranh tổng hợp nhiều truyện nhất Việt Nam, manga,
                        manhua, manhwa, truyentranh18</p>

                    <!-- <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="50000"><img class="responsive-img" src="img/fb4848.png"></a>
                    <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="50000"><img class="responsive-img" src="img/pin4848.png"></a>
                    <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="50000"><img class="responsive-img" src="img/ggplus4848.png"></a>
                    <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="50000"><img class="responsive-img" src="img/tw4848.png"></a> -->
                </div>
                <div class="fb-page"
                     data-href="https://www.facebook.com/Flipmanga-Manga-community-share-and-read-mangamanhwamanhua-for-free-571436729717447/"
                     data-tabs="no" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false"
                     data-show-facepile="true">
                    <blockquote
                            cite="https://www.facebook.com/Flipmanga-Manga-community-share-and-read-mangamanhwamanhua-for-free-571436729717447/"
                            class="fb-xfbml-parse-ignore"><a
                                href="https://www.facebook.com/Flipmanga-Manga-community-share-and-read-mangamanhwamanhua-for-free-571436729717447/">Smovies.tv
                            - Free movies online</a></blockquote>
                </div>

                <div class="card-panel no-padding">
                    <div class="row no-padding">
                        <div class="col s12">
                            <ul class="tabs teal darken-3">
                                <li class="tab col s12"><a class="active white-text" href="#test1">Top trong ngày</a></li>
                                {{--<li class="tab col s6"><a  href="#test2">Top Week</a></li>--}}
                            </ul>
                        </div>
                        <div id="test1" class="col s12">
                            <div class="collection">
                                @foreach($topToday as $item)
                                    @if($loop->index<=2)
                                        <a href="{{route('manga',['manga'=>$item->slug])}}"
                                           class="black-text collection-item truncate"><h3
                                                    class="title-h3-normal left">{{$item->name}}</h3><span
                                                    class="white-text badge red ">{{$loop->index+1}}</span></a>
                                    @else
                                        <a href="{{route('manga',['manga'=>$item->slug])}}"
                                           class="black-text collection-item truncate"><h3
                                                    class="title-h3-normal">{{$item->name}}</h3></a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        {{--<div id="test2" class="col s12">Test 2</div>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="card-panel z-depth-0 transparent padding-0">
                <div class="row">
                    <div class="col s12  ">
                        <ul class="tabs teal darken-3 z-depth-1">
                            <li class="tab"><a class="active white-text" href="#tab-container1">Truyện mới cập nhật</a></li>
                            <li class="tab"><a class="white-text" data-content="random" data-role="tab-genre" href="#tab-container2">Truyện
                                    ngẫu nhiên</a></li>
                            <li class="tab"><a class="white-text" data-content="manhwa" data-role="tab-genre" href="#tab-container3">Hàn
                                    Quốc</a></li>
                            <li class="tab"><a class="white-text" data-content="manhua" data-role="tab-genre" href="#tab-container4">Trung
                                    Quốc</a></li>
                        </ul>

                    </div>
                    <div id="tab-container1">
                        @each('manga.partial._manga', $latestUpdate, 'item')
                        {{--@foreach($latestUpdate as $item)--}}
                        {{--@include('manga.partial._manga')--}}
                        {{--@endforeach--}}
                        <div class="col s12 center">
                            <a href="{{route('manga.latest')}}" class="btn btn-more white grey-text">more</a>
                        </div>
                    </div>
                    <div id="tab-container2">
                        <div class="col s12 center ">
                            <div class="loader-container">
                                <div class="preloader-wrapper active">
                                    <div class="spinner-layer spinner-red-only">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="gap-patch">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-container3">
                        <div class="col s12 center ">
                            <div class="loader-container">
                                <div class="preloader-wrapper active">
                                    <div class="spinner-layer spinner-red-only">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="gap-patch">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-container4">
                        <div class="col s12 center ">
                            <div class="loader-container">
                                <div class="preloader-wrapper active">
                                    <div class="spinner-layer spinner-red-only">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="gap-patch">
                                            <div class="circle"></div>
                                        </div>
                                        <div class="circle-clipper right">
                                            <div class="circle"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 center">
                <a href="" rel="tag" class="chip white-text ">Tags</a>
                <a href="{{route('genre',['genre'=>'harem'])}}" rel="tag"
                   class="chip white-text pink darken-4">#harem</a>
                <a href="{{route('genre',['genre'=>'romance'])}}" rel="tag" class="chip white-text purple darken-4">#romance</a>
                <a href="{{route('genre',['genre'=>'shoujo'])}}" rel="tag" class="chip white-text indigo darken-1">#shoujo</a>
                <a href="{{route('genre',['genre'=>'shounen'])}}" rel="tag" class="chip white-text teal darken-3">#shounen</a>
                <a href="{{route('genre',['genre'=>'mecha'])}}" rel="tag"
                   class="chip white-text orange darken-4">#mecha</a>
                <a href="{{route('genre',['genre'=>'ecchi'])}}" rel="tag"
                   class="chip white-text teal darken-4">#ecchi</a>
                <a href="#" rel="tag" class="chip white-text red darken-4">#manga</a>
                <a href="#" rel="tag" class="chip white-text purple darken-4">#manhwa</a>
                <a href="#" rel="tag" class="chip white-text blue darken-4">#manhua</a>

            </div>
        </div>
    </div><!-- container -->
    <!-- end content -->
    </div>
@endsection
