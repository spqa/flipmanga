<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->


    <!--Let browser know website is optimized for mobile-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="{{asset('css/materialize.min.css')}}" >

    <!-- Important Owl stylesheet -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}">

    <!-- Default Theme -->
    <link rel="stylesheet" href="{{asset('css/owl.theme.css')}}">

    <link rel="stylesheet" href="{{asset('css/style.css')}}" >

    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body >
<nav>
    <div class="nav-wrapper  blue darken-4">
        {{--<div class="container">--}}
            <a href="/" class="brand-logo center"><img height="68px" src="{{asset('img/flip.png')}}"/></a>
            <a href="#" data-activates="mobile-sidebar" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="left hide-on-med-and-down">
                <li><a href="/">Home</a></li>
                <li><a href="#" class="genres-mega-menu">Genres</a>
                    <div class="card-panel mega-menu white-text white z-depth-4" >
                        <div class="row black-text no-padding" >
                            @foreach($allGenres as $genre)
                                <div class="col s2 mega-menu-content no-padding"><a href="{{route('genre',['genre'=>$genre->slug])}}" class="truncate">{{$genre->name}}</a></div>
                            @endforeach
                        </div>
                    </div>
                </li>

                <li><a href="{{route('manga.full')}}">Full</a></li>
                <li><a href="{{route('manga.latest')}}">Latest Releases</a></li>
            </ul>
            <ul id="nav-mobile" class="right hide-on-med-and-down">

                <li>
                    <form>
                        <div class="input-field">
                            <input id="search" type="search" required>
                            <label for="search"><i class="material-icons">search</i></label>
                            <i class="material-icons">close</i>
                        </div>
                    </form>
                </li>
                <li>
                    <a class="btn-flat white-text green">Contact</a>
                </li>
                <li>
                    <button class="btn-flat white-text orange">Login</button>
                </li>
            </ul>
        {{--</div>--}}
        <ul class="side-nav" id="mobile-sidebar">
            <li class="indigo darken-4 center"><a href="/"><img height="50px" src="{{asset('img/flip.png')}}"/></a></li>
            <li class="black-text">
{{--                <form action="{{route}}">--}}
                <input id="search" type="text" placeholder="Search manga" required>
                {{--</form>--}}
            </li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header">Genres<i class="material-icons">arrow_drop_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                @foreach($allGenres as $genre)
                                    <li><a href="{{route('genre',['genre'=>$genre->slug])}}">{{$genre->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li><a href="/">Return Home</a></li>
            <li><a href="{{route('manga.full')}}">Full manga</a></li>
            <li><a href="{{route('manga.latest')}}">Latest Releases</a></li>
            <li>
                <a href="#" class="left no-padding"><img  src="{{asset('img/fb4848.png')}}"></a>
                <a href="#" class="left no-padding"><img  src="{{asset('img/ggplus4848.png')}}"></a>
                <a href="#" class="left no-padding"><img  src="{{asset('img/tw4848.png')}}"></a>
                <a href="#" ><img  src="{{asset('img/pin4848.png')}}"></a>
            </li>
        </ul>
    </div>

</nav>
<!-- end nav -->
@yield('content')
<!-- start footer -->
<footer class="page-footer grey darken-4">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text">Flipmanga.com</h5>
                <p class="grey-text text-lighten-4">Read manga, manhwa, manhua, comic,... online for free</p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="#!">Home</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">DMCA</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Request Manga</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Contact us!</a></li>
                </ul>
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
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '204795013306485',
            xfbml      : true,
            version    : 'v2.8'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools --> <script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57a557dc5a728f4b"></script>
</body>
</html>