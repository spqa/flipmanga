<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <title>{{$manga->name}} |{{$chapter->name}} | Đọc truyện tranh {{$manga->name}} {{$chapter->name}} miễn phí</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <!--Let browser know website is optimized for mobile-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css" >

    <!-- Important Owl stylesheet -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}">

    <!-- Default Theme -->
    <link rel="stylesheet" href="{{asset('css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="manga-id" content="{{$manga->id}}"/>
    <meta name="csrf-token" content="{{csrf_token()}}"/>
</head>
<body>
<div id="navbar-wrapper">
<nav class="grey darken-4">
    <div class="container ">
        <div class="nav-wrapper">
            <div class="col s12 scroll-breadcrumb transparent ">
                <a href="/" class="breadcrumb"><i class="material-icons">home</i>Trang chủ</a>
                @if($main_genre)
                <a href="{{route('genre',['genres'=>$main_genre->slug])}}" class=" breadcrumb">{{$main_genre->name}}</a>
                @endif
                <a href="{{route('manga',['manga'=>$manga->slug])}}" class=" breadcrumb ">{{$manga->name}}</a>
                <a href="#" class="breadcrumb active">{{$chapter->name}}</a>
            </div>
        </div>
    </div>

</nav>
</div>
<div class="container-fluid grey lighten-4">
    <div class="row">
        <div class="col s12">
            <div class="card-panel z-depth-0 transparent">
                <h3 class="inline">{{$manga->name}}</h3>
                @if(!empty($manga->alias))
                <h4 class="inline">({{$manga->alias}})</h4><br/>
                @endif
                <h5 class="grey-text inline">{{$chapter->name}}</h5>
                <div>
                    @foreach($manga->getCachedGenres() as $item)
                        <a href="{{route('genre',['genres'=>$item->slug])}}" class="chip deep-orange darken-3 white-text">{{$item->name}}</a>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="fixed-action-btn btn-forward">
{{--        {!! dd($next_link) !!}--}}
        <a href="{{isset($next_link)?route('manga.chapter',['manga'=>$manga->slug,'chapter_slug'=>$next_link->slug]):'#!'}}"
           class="btn-floating btn-large {{isset($next_link)?'red':'grey'}}">
            <i class="material-icons">keyboard_arrow_right</i>
        </a>
    </div>
    <div class="fixed-action-btn btn-rewind">
        <a href="{{isset($prev_link)?route('manga.chapter',['manga'=>$manga->slug,'chapter_slug'=>$prev_link->slug]):'#!'}}"
           class="btn-floating btn-large {{isset($prev_link)?'red':'grey'}}">
            <i class="material-icons">keyboard_arrow_left</i>
        </a>
    </div>
    <div class="fixed-action-btn btn-chapter">
        <a href="#modal3" class="btn-floating btn-large teal">
            <i class="material-icons">toc</i>
        </a>
    </div>
    <div class="row">
        <div class="col s12 center">
            @foreach($array_img as $value)
                <img class="responsive-img manga-image" src="{{$value}}">
            @endforeach
        </div>
    </div>
    <!-- model chapter -->
    <div id="modal3" class="modal bottom-sheet" >
        <div class="modal-content">
            <h4>Danh sách chap</h4>
            <ul class="collection">
                @foreach($manga->chapters as $chapter)
                    <a href="{{route('manga.chapter',['manga'=>$manga->slug,'chapter_slug'=>$chapter->slug])}}"
                       class="collection-item">{{$chapter->name}}</a>
                    @endforeach
            </ul>
        </div>
    </div>
    <div class="center">
        <div class="fb-like" data-href="{{secure_url('/truyen/'.$manga->slug)}}" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
    </div>
    <!-- model chapter -->
    <div id="end-of-page"></div>
    <div class="container">
        <div class="fb-comments" data-width="100%" data-href="{{url()->current()}}" data-numposts="5"></div>
    </div>
    <script src="{{asset('js/chapter.js?v=0.1')}}"></script>

</div>
<footer class="page-footer grey darken-4">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h4 class="white-text title-h2">Truyentranh18.net</h4>
                <p class="grey-text text-lighten-4">Đọc truyện manga, manhwa, manhua, comic,... với chap mới nhất miễn
                    phí</p>
                <h4 class="white-text title-h2">Truyện Nhật Bản mới nhất</h4>
                <a href="{{route('manga.latest')}}" class="grey-text text-lighten-4">Đọc manga, Truyện Nhật Bản online
                    mới nhất</a>
                <h4 class="white-text title-h2">Truyện Trung Quốc mới nhất</h4>
                <a href="{{route('manhua.latest')}}" class="grey-text text-lighten-4">Đọc manhua, truyện Trung Quốc
                    online mới nhất</a>
                <h4 class="white-text title-h2">Truyện Hàn Quốc mới nhất</h4>
                <a href="{{route('manhwa.latest')}}" class="grey-text text-lighten-4">Đọc manhwa, truyện Hàn Quốc online
                    mới nhất</a>
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
</body>
</html>