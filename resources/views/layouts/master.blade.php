<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title','Flipmanga.com|Read manga, manhwa, manhua latest chap free online')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="language" content="en">
    <meta name="description"
          content="@yield('meta_des','Flipmanga.com is a site dedicated to bringing you the coolest manga, manhwa, manhua resources for free with latest chapter')">
    <meta name="keywords"
          content="free manga, free mangas, free mangas online, watch free mangas online, watch manga online free, watch free manga, free full manga, free online manga, free manga websites, manga, mangas, manhwa, manhua">
    <link rel="canonical" href="@yield('canonical','http://flipmanga.com/')"/>
    <meta itemprop="name" content="Flipmanga"/>
    <meta itemprop="description"
          content="@yield('meta_des','Flipmanga.com is a site dedicated to bringing you the coolest manga, manhwa, manhua resources for free')"/>
    <meta itemprop="image" content="@yield('image',asset('/img/flip.png'))"/>
    <meta property="fb:app_id" content="1729477510640705">
    <meta property="og:title" content="@yield('title','Flipmanga.com | Read Free manga Online Website') ">
    <meta property="og:url" content="@yield('og_url','http://flipmanga.com')"/>
    <meta property="og:type" content="@yield('og_type','website')"/>
    <meta property="og:description"
          content="@yield('meta_des','Flipmanga.com is a site dedicated to bringing you the coolest manga, manhwa, manhua resources for free')">
    <meta property="og:image" content="@yield('image','/img/flip.png')"/>
    <meta property="og:site_name" content="flipmanga.com"/>
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#0D47A1">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <!--Let browser know website is optimized for mobile-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="{{asset('css/materialize.min.css')}}">

    <!-- Important Owl stylesheet -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}">

    <!-- Default Theme -->
    <link rel="stylesheet" href="{{asset('css/owl.theme.css')}}">

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
<script type="application/ld+json">
        {
          "@context" : "https://schema.org",
          "@type" : "Organization",
          "name" : "flipmanga",
          "url" : "http://flipmanga.com",
          "sameAs" : [
          "https://www.facebook.com/Flipmanga-Manga-community-share-and-read-mangamanhwamanhua-for-free-571436729717447/"
          ]
      }

</script>
<nav>
    <div class="nav-wrapper  blue darken-4">
        {{--<div class="container">--}}
        <a href="/" class="brand-logo center"><img alt="Flipmanga Logo" title="Flipmanga Logo" height="68px"
                                                   src="{{asset('img/flip.png')}}"/></a>
        <a href="#" data-activates="mobile-sidebar" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="/">Home</a></li>
            <li><a href="/genre" class="genres-mega-menu">Manga Genres</a>
                <div class="card-panel mega-menu white-text white z-depth-4">
                    <div class="row black-text no-padding">
                        @foreach($allGenres as $genre)
                            <div class="col s2 mega-menu-content no-padding"><a title="{{$genre->name}}"
                                                                                href="{{route('genre',['genre'=>$genre->slug])}}"
                                                                                class="truncate">{{$genre->name}}</a>
                            </div>
                        @endforeach
                        <div class="col s2 mega-menu-content no-padding"><a title="manhwa"
                                                                            href="{{route('manhwa.latest')}}"
                                                                            class="truncate">Manhwa</a></div>
                        <div class="col s2 mega-menu-content no-padding"><a title="manhua"
                                                                            href="{{route('manhua.latest')}}"
                                                                            class="truncate">Manhua</a></div>
                    </div>

                </div>
            </li>

            <li><a href="{{route('manga.full')}}">Full Manga</a></li>
            <li><a href="{{route('manga.latest')}}">Latest Releases Manga</a></li>
        </ul>
        <ul id="nav-mobile" class="right hide-on-med-and-down">

            <li>
                <form action="/search">
                    <div class="input-field">
                        <form action="/search">
                            <input name="query" id="search" type="search" required>
                            <label for="search"><i class="material-icons">search</i></label>
                            <i class="material-icons">close</i>
                        </form>
                    </div>
                </form>
            </li>
            <li>
                <a class="btn-flat white-text green">Contact</a>
            </li>
            @if(auth()->check() && auth()->user()->avatar)
                <li><img class="user-avatar" src="{{auth()->user()->avatar}}"/></li>
            @endif
            <li>
                @if(auth()->check())
                    <a style="min-width: 136px" class="dropdown-button" href="#!"
                       data-activates="dropdown1">{{auth()->user()->name}}<i
                                class="material-icons right">arrow_drop_down</i></a>
                @else
                    <a href="{{route('login')}}" class="btn-flat white-text orange">Login</a>
                @endif
            </li>
        </ul>
        {{--</div>--}}
        <ul class="side-nav" id="mobile-sidebar">
            <li class="indigo darken-4 center"><a href="/"><img height="50px" src="{{asset('img/flip.png')}}"/></a></li>
            <li class="black-text">
                <form action="/search">
                    <input id="search" name="query" type="search" placeholder="Search manga" required>
                </form>
            </li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    @if(!auth()->check())
                        <li><a class="orange-text" href="{{route('login')}}"><i class="material-icons">person
                                    outline</i>Login</a></li>
                    @else
                        <li>
                            <a class="collapsible-header"><img class="user-avatar right"
                                                               src="{{auth()->user()->avatar}}"> {{auth()->user()->name}}
                                <i class="material-icons">arrow_drop_down</i></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="#" class="white-text red">Favorite<i
                                                    class="material-icons">favorite</i></a></li>
                                    <li><a href="#" class="btn-logout">Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    <li>
                        <a href="#" class="collapsible-header">Manga Genres<i class="material-icons">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                @foreach($allGenres as $genre)
                                    <li><a title="{{$genre->name}}"
                                           href="{{route('genre',['genre'=>$genre->slug])}}">{{$genre->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li><a href="/">Return Home</a></li>
            <li><a href="{{route('manga.full')}}">Full manga</a></li>
            <li><a href="{{route('manga.latest')}}">Latest Releases Manga</a></li>
            {{--<li>--}}
            {{--<a href="#" class="left no-padding"><img src="{{asset('img/fb4848.png')}}"></a>--}}
            {{--<a href="#" class="left no-padding"><img src="{{asset('img/ggplus4848.png')}}"></a>--}}
            {{--<a href="#" class="left no-padding"><img src="{{asset('img/tw4848.png')}}"></a>--}}
            {{--<a href="#"><img src="{{asset('img/pin4848.png')}}"></a>--}}
            {{--</li>--}}
        </ul>
    </div>
    <ul id="dropdown1" class="dropdown-content">
        <li><a href="{{route('favorite')}}" class="white-text red">Favorite<i class="material-icons right">favorite</i></a>
        </li>
        {{--<li class="divider"></li>--}}
        <li><a class="btn-logout">Logout</a></li>
    </ul>

</nav>
<!-- end nav -->
@yield('content')
<!-- start footer -->
<footer class="page-footer grey darken-4">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h4 class="white-text title-h2">Flipmanga.com</h4>
                <p class="grey-text text-lighten-4">Read manga, manhwa, manhua, comic,... with latest chapters online
                    for free</p>
                <h4 class="white-text title-h2">Latest Manga</h4>
                <a href="{{route('manga.latest')}}" class="grey-text text-lighten-4">Read latest manga online for
                    free</a>
                <h4 class="white-text title-h2">Latest Manhua</h4>
                <a href="{{route('manhua.latest')}}" class="grey-text text-lighten-4">Read latest manhua online for
                    free</a>
                <h4 class="white-text title-h2">Latest Manhwa</h4>
                <a href="{{route('manhwa.latest')}}" class="grey-text text-lighten-4">Read latest manhwa online for
                    free</a>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="#!">Home</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">DMCA</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Request Manga ,Manhua, Manhwa</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Contact us!</a></li>
                </ul>
            </div>
            <div class="col s12 center">
                <a class="chip indigo white-text" href="/manga/sweet-guy"><h5 class="title-h5">Sweet Guy manhwa</h5></a>
                <a class="chip indigo white-text" href="/manga/tales-of-demons-and-gods"><h5 class="title-h5">Tales of
                        Demons and Gods manhua</h5></a>
                <a class="chip indigo white-text" href="/manga/relife"><h5 class="title-h5">ReLIFE (Re LIFE) manga</h5>
                </a>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2017 All Rights Reserved - FlipManga.com
            <a class="grey-text text-lighten-4 right" href="/">Flipmanga.com</a>
        </div>
    </div>

</footer>
<!-- end footer -->
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="{{asset('js/materialize.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}} "></script>
{{--<script src="//cdn.jsdelivr.net/hogan.js/3.0.2/hogan.min.js"></script>--}}
<script src="{{asset('js/jquery.lazyloadxt.simple.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
@yield('page_script')
<script>
    window.fbAsyncInit = function () {
        FB.init({
            appId: '613058618881383',
            xfbml: true,
            version: 'v2.8'
        });
    };

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57a557dc5a728f4b"></script>
</body>
</html>