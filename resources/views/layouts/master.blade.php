<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title','Truyện tranh 18+,đọc truyện tranh online miễn phí,truyện manga,manhwa,manhua')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="language" content="en">
    <meta name="description"
          content="@yield('meta_des','Trang truyện tranh online miễn phí, truyện tranh tổng hợp nhiều truyện nhất Việt Nam, manga,manhua,manhwa,truyentranh18')">
    <meta name="keywords"
          content="truyện tranh, truyentranh 18+, truyen tranh 18+, manga, đọc truyện tranh online, cổng truyện dịch, truyện tranh online, manga online, xem truyện, xem truyện tranh online, xem truyện online, vechai, manga24h, blogtruyen, truyện tranh 18, manhua, manhwa">
    <link rel="canonical" href="@yield('canonical',secure_url('/'))"/>
    <meta itemprop="name" content="Truyentranh18"/>
    <meta itemprop="description"
          content="@yield('meta_des','Trang truyện tranh online miễn phí, truyện tranh tổng hợp nhiều truyện nhất Việt Nam, manga,manhua,manhwa,truyentranh18')"/>
    <link hreflang="vi" href="{{secure_url('/')}}">
    <meta itemprop="image" content="@yield('image',asset('/img/flip.png'))"/>
    <meta property="fb:app_id" content="1729477510640705">
    <meta property="og:title"
          content="@yield('title','Truyện tranh 18+,đọc truyện tranh online miễn phí,truyện manga,manhwa,manhua') ">
    <meta property="og:url" content="@yield('og_url',secure_url('/'))"/>
    <meta property="og:type" content="@yield('og_type','website')"/>
    <meta property="og:description"
          content="@yield('meta_des','Trang truyện tranh online miễn phí, truyện tranh tổng hợp nhiều truyện nhất Việt Nam, manga,manhua,manhwa,truyentranh18')">
    <meta property="og:image" content="@yield('image','/img/flip.png')"/>
    <meta property="og:site_name" content="truyentranh18.net"/>
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
    <meta name="email" content="contact.flipmanga@gmail.com"/>
    <meta name="Charset" content="UTF-8"/>
    <meta name="Distribution" content="Global"/>
    <meta name="Rating" content="General"/>
    <meta name="google-site-verification" content="apRpDG4wC-Ah-Yl93_u_QnwRXoCI5MXdw6cUFZaR_CY"/>

    <meta name="Revisit-after" content="1 Days"/>
    <meta content="1800" http-equiv="REFRESH"/>

    <!--Let browser know website is optimized for mobile-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="{{asset('css/materialize.min.css')}}">

    <!-- Important Owl stylesheet -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}">

    <!-- Default Theme -->
    <link rel="stylesheet" href="{{asset('css/owl.theme.css')}}">

    <link rel="stylesheet" href="{{asset('css/style.css?v=0.2')}}">
</head>

<body>
<script type="application/ld+json">
        {
          "@context" : "https://schema.org",
          "@type" : "Organization",
          "name" : "Truyentranh18",
          "url" : "{{secure_url('/')}}",
          "sameAs" : [
          "https://www.facebook.com/Flipmanga-Manga-community-share-and-read-mangamanhwamanhua-for-free-571436729717447/"
          ]
      }



</script>
<div id="navbar-master">
    <nav>
    <div class="nav-wrapper  blue darken-4">
        {{--<div class="container">--}}
        <a href="/" class="brand-logo center">Truyentranh18</a>
        <a href="#" data-activates="mobile-sidebar" class="button-collapse"><i class="material-icons">menu</i></a>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="/">Trang chủ</a></li>
            <li><a href="/the-loai" class="genres-mega-menu">Thể loại</a>
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

            <li><a href="{{route('manga.full')}}">Truyện Full</a></li>
            <li><a href="{{route('manga.latest')}}">Truyện mới </a></li>
        </ul>
        <ul id="nav-mobile" class="right hide-on-med-and-down">

            <li>
                <form action="/tim-kiem">
                    <div class="input-field">
                            <input name="query" id="search" type="search" required>
                        <label for="search"><i class="icon-search material-icons">search</i></label>
                            <i class="material-icons">close</i>
                    </div>
                </form>
            </li>
            <li>
                <a href="{{route('contact')}}" class="btn-flat white-text green">Liên hệ</a>
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
                    <a href="{{route('login')}}" class="btn-flat white-text orange">Đăng nhập</a>
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
                                    outline</i>Đăng nhập</a></li>
                    @else
                        <li>
                            <a class="collapsible-header"><img class="user-avatar right"
                                                               src="{{auth()->user()->avatar}}"> {{auth()->user()->name}}
                                <i class="material-icons">arrow_drop_down</i></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="#" class="white-text red">Yêu thích<i
                                                    class="material-icons">favorite</i></a></li>
                                    <li><a href="#" class="btn-logout">Đăng xuất</a></li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    <li>
                        <a href="#" class="collapsible-header">Thể loại<i class="material-icons">arrow_drop_down</i></a>
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
            <li><a href="/">Trang chủ</a></li>
            <li><a href="{{route('manga.full')}}">Truyện Full</a></li>
            <li><a href="{{route('manga.latest')}}">Truyện mới ra</a></li>
            {{--<li>--}}
            {{--<a href="#" class="left no-padding"><img src="{{asset('img/fb4848.png')}}"></a>--}}
            {{--<a href="#" class="left no-padding"><img src="{{asset('img/ggplus4848.png')}}"></a>--}}
            {{--<a href="#" class="left no-padding"><img src="{{asset('img/tw4848.png')}}"></a>--}}
            {{--<a href="#"><img src="{{asset('img/pin4848.png')}}"></a>--}}
            {{--</li>--}}
        </ul>
    </div>
    <ul id="dropdown1" class="dropdown-content">
        <li>
            <a href="{{route('favorite')}}" class="white-text red">Yêu thích</a>
        </li>
        <li>
            <a href="{{route('manga.create')}}">Đăng truyện</a>
        </li>
        {{--<li class="divider"></li>--}}
        <li><a class="btn-logout">Đăng xuất</a></li>
    </ul>

</nav>
</div>
<!-- end nav -->
@yield('content')
<!-- start footer -->
<footer class="page-footer grey darken-4">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h4 class="white-text title-h2">Truyentranh18.net</h4>
                <p class="grey-text text-lighten-4">Đọc truyện manga, manhwa, manhua, comic,... với chap mới nhất miễn phí</p>
                <h4 class="white-text title-h2">Truyện Nhật Bản mới nhất</h4>
                <a href="{{route('manga.latest')}}" class="grey-text text-lighten-4">Đọc manga, Truyện Nhật Bản online mới nhất</a>
                <h4 class="white-text title-h2">Truyện Trung Quốc mới nhất</h4>
                <a href="{{route('manhua.latest')}}" class="grey-text text-lighten-4">Đọc manhua, truyện Trung Quốc online mới nhất</a>
                <h4 class="white-text title-h2">Truyện Hàn Quốc mới nhất</h4>
                <a href="{{route('manhwa.latest')}}" class="grey-text text-lighten-4">Đọc manhwa, truyện Hàn Quốc online mới nhất</a>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                    <li><a class="grey-text text-lighten-3" href="#!">Trang chủ</a></li>
                    <li><a class="grey-text text-lighten-3" href="{{route('manga.tos')}}">Term of service</a></li>
                    <li><a class="grey-text text-lighten-3" href="{{route('manga.priv')}}">Privacy Policy</a></li>
                    <li><a class="grey-text text-lighten-3" href="#!">Yêu cầu nhờ vả Manga ,Manhua, Manhwa</a></li>
                    <li><a class="grey-text text-lighten-3" href="{{route('contact')}}">Liên hệ !</a></li>
                    <li>@include('dmca')</li>
                </ul>
            </div>
            <div class="col s12 center">
                <p class="grey-text">Mọi thông tin và hình ảnh trên website điều được thành viên sưu tầm trên internet.
                    Toàn bộ nội dung trên web do thành viên đăng tải và chia sẻ. Chúng tôi không sở hữu hay chịu trách
                    nhiệm bất kỳ thông tin nào trên web này. Nếu làm ảnh hưởng đến cá nhân hay tổ chức nào, khi được yêu
                    cầu qua email, chúng tôi sẽ xem xét và gỡ bỏ ngay lập tức.</p>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            © 2017 All Rights Reserved - truyentranh18.net
            <a class="grey-text text-lighten-4 right" href="/">truyentranh18.net</a>
        </div>
    </div>

</footer>
<!-- end footer -->
<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="{{asset('js/materialize.min.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}} "></script>
{{--<script src="//cdn.jsdelivr.net/hogan.js/3.0.2/hogan.min.js"></script>--}}
<script src="{{asset('js/jquery.lazyloadxt.simple.js')}}"></script>
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
<script src="{{asset('js/script.js?v=0.3')}}"></script>
<script type="text/javascript" src="http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-57a557dc5a728f4b"></script>
<script id="cid0020000150789223515" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js"
        style="width: 200px;height: 300px;">{
        "handle"
    :
        "truyentranh18vn", "arch"
    :
        "js", "styles"
    :
        {
            "a"
        :
            "336666", "b"
        :
            100, "c"
        :
            "FFFFFF", "d"
        :
            "FFFFFF", "k"
        :
            "336666", "l"
        :
            "336666", "m"
        :
            "336666", "n"
        :
            "FFFFFF", "p"
        :
            "10", "q"
        :
            "336666", "r"
        :
            100, "pos"
        :
            "br", "cv"
        :
            1, "cvfnt"
        :
            "monospace, sans-serif", "cvbg"
        :
            "336666", "cvw"
        :
            200, "cvh"
        :
            30, "ticker"
        :
            1, "fwtickm"
        :
            1
        }
    }</script>
</body>
</html>