@extends('layouts.master')
@section('content')
    <!-- start content -->

    <div class="container ">
        <div class="row hide-on-med-and-up margin-0">
            <div class="col s12 center">
                <!-- Go to www.addthis.com/dashboard to customize your tools --> <div class="addthis_inline_share_toolbox_vmgx"></div>
            </div>
        </div>
        <div class="row hide-on-small-only">
            <div class="col l9 s12 m12">
                <div class="card-panel no-padding hide-on-small-only z-depth-0">

                    <div class="row">
                        <div class="col s12">
                            <div class="carousel carousel-slider">
                                <a class="carousel-item" href="#two!"><img src="{{asset('img/banner/1.jpg')}}"></a>
                                <a class="carousel-item" href="#one!"><img src="img/banner1.jpg"></a>
                                <a class="carousel-item" href="#three!"><img src="img/banner2.jpg "></a>
                                <a class="carousel-item" href="#four!"><img src="{{asset('img/banner/tail.jpg')}}"></a>
                            </div>
                        </div>
                        <div class="col s12">
                            <h2 class="left title-h2 brown-text darken-4">Latest Hot Manga Update</h2>
                            <button data-role="slide-next" class="btn right grey lighten-4 slide-navi"><i class="material-icons medium grey-text">keyboard_arrow_right</i></button>
                            <button data-role="slide-prev" class="btn right grey lighten-4 slide-navi"><i class="material-icons medium grey-text">keyboard_arrow_left</i></button>
                        </div>
                        <div class="col s12 m12 l12">

                            <div class="slide-container">
                                @foreach($latestHotUpdate as $item)
                                @include('manga.partial._manga_slider')
                                @endforeach
                                <div class="slider-loading center">
                                    <div class="preloader-wrapper active ">
                                        <div class="spinner-layer spinner-green-only">
                                            <div class="circle-clipper left">
                                                <div class="circle"></div>
                                            </div><div class="gap-patch">
                                                <div class="circle"></div>
                                            </div><div class="circle-clipper right">
                                                <div class="circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- slide-container -->


                        </div><!-- col-s12 -->
                    </div><!-- row -->
                    <!-- </div> -->
                    <!-- section -->

                    <!-- <div class="divider"></div> -->
                    <!-- <div class="section card-panel no-padding hide-on-small-only z-depth-0"> -->
                    <div class="row">
                        <div class="col s12">
                            <h2 class="left title-h2 brown-text darken-4">New Release</h2>
                            <button data-role="slide-next" class="btn right grey lighten-4 slide-navi"><i class="material-icons medium grey-text">keyboard_arrow_right</i></button>
                            <button data-role="slide-prev" class="btn right grey lighten-4 slide-navi"><i class="material-icons medium grey-text">keyboard_arrow_left</i></button>
                        </div>
                        <div class="col s12 m12 l12">

                            <div class="slide-container">
                                @foreach($newRelease as $item)
                                    @include('manga.partial._manga_slider')
                                    @endforeach
                            </div><!-- slide-container -->


                        </div><!-- col-s12 -->
                    </div><!-- row -->
                    <!-- </div> -->
                    <!-- <div class="divider"></div> -->
                    <!-- <div class="section card-panel padding-0 hide-on-small-only z-depth-0"> -->
                    <!-- <div class="row"> -->
                    <!-- <div class="col s12 m4 l4"> -->
                    <!-- <div class="card-panel teal">
                    <span class="white-text"> -->
                    <h2 class="title-h2 brown-text darken-4">Top Manga</h2>
                    <!-- </span>
                  </div> -->
                    <!-- </div> -->
                    <!-- </div> -->
                    <div class="row">
                        <div class="col s12 m12 l12">

                            <div class="slide-container">
                                @foreach($recommend as $item)
                                    @include('manga.partial._manga_slider')
                                    @endforeach
                            </div><!-- slide-container -->


                        </div><!-- col-s12 -->
                    </div><!-- row -->
                </div>
            </div>
            <div class="col hide-on-med-and-down l3 sidebar">
                <div class="card-panel center ">
                    <p>Tutorialzine is a site dedicated to bringing you the coolest web development tutorials and resources. Follow us!</p>

                    <!-- <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="50000"><img class="responsive-img" src="img/fb4848.png"></a>
                    <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="50000"><img class="responsive-img" src="img/pin4848.png"></a>
                    <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="50000"><img class="responsive-img" src="img/ggplus4848.png"></a>
                    <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="50000"><img class="responsive-img" src="img/tw4848.png"></a> -->
                </div>
                <div class="fb-page" data-href="https://www.facebook.com/smovies.tv/" data-tabs="no" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/smovies.tv/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/smovies.tv/">Smovies.tv - Free movies online</a></blockquote></div>

                <div class="card-panel no-padding">
                    <div class="row  no-padding">
                        <div class="col s12">
                            <ul class="tabs">
                                <li class="tab col s6"><a class="active" href="#test1">Top Today</a></li>
                                <li class="tab col s6"><a  href="#test2">Top Week</a></li>
                            </ul>
                        </div>
                        <div id="test1" class="col s12">
                            <div class="collection">
                                @foreach($topToday as $item)
                                    @if($loop->index<=2)
                                        <a href="{{route('manga',['manga'=>$item->slug])}}" class="collection-item truncate">{{$item->name}}<span class="white-text badge red">{{$loop->index+1}}</span></a>
                                        @else
                                        <a href="{{route('manga',['manga'=>$item->slug])}}" class="collection-item truncate">{{$item->name}}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        <div id="test2" class="col s12">Test 2</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="card-panel padding-0">
                <div class="row">
                    <div class="col s12 ">
                        <ul class="tabs z-depth-1">
                            <li class="tab"><a class="active" href="#tab-container1">Latest Update</a></li>
                            <li class="tab"><a href="#">Shoujo</a></li>
                            <li class="tab"><a href="#">Shounen</a></li>
                            <li class="tab"><a href="#tab-container2">Random</a></li>
                        </ul>

                    </div>
                    <div id="tab-container1">
                        @foreach($latestUpdate as $item)
                        @include('manga.partial._manga')
                            @endforeach
                    </div>
                    <div id="tab-container2">
                        <div class="col s12 center ">
                            <div class="loader-container">
                                <div class="preloader-wrapper active">
                                    <div class="spinner-layer spinner-red-only">
                                        <div class="circle-clipper left">
                                            <div class="circle"></div>
                                        </div><div class="gap-patch">
                                            <div class="circle"></div>
                                        </div><div class="circle-clipper right">
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
                <div class="chip">Tags</div>
                <div class="chip">#harem</div>
                <div class="chip">#romance</div>
                <div class="chip">#shoujo</div>
                <div class="chip">#shounen</div>
                <div class="chip">#mecha</div>

            </div>
        </div>
    </div><!-- container -->
    <!-- end content -->
    @endsection
