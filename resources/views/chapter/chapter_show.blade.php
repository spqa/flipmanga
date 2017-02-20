<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->

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
<nav class="blue darken-4 ">
    <div class="container ">
        <div class="nav-wrapper">
            <div class="col s12">
                <a href="/" class="breadcrumb "><i class="material-icons">home</i>Home</a>
                @if($main_genre)
                <a href="{{route('genre',['genres'=>$main_genre->slug])}}" class="breadcrumb">{{$main_genre->name}}</a>
                @endif
                <a href="{{route('manga',['manga'=>$manga->slug])}}" class="breadcrumb ">{{$manga->name}}</a>
                <a href="#" class="breadcrumb active">{{$chapter->name}}</a>
            </div>
        </div>
    </div>

</nav>
</div>
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card-panel z-depth-0">
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
        <a  href="{{isset($next_link)?route('manga',['manga'=>$manga->slug,'chapter'=>$next_link]):'#'}}" class="btn-floating btn-large red">
            <i class="material-icons">keyboard_arrow_right</i>
        </a>
    </div>
    <div class="fixed-action-btn btn-rewind">
        <a href="{{isset($prev_link)?route('manga',['manga'=>$manga->slug,'chapter'=>$prev_link]):'#'}}" class="btn-floating btn-large red">
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
            <h4>Chapter List</h4>
            <ul class="collection">
                @foreach($manga->chapters as $chapter)
                <a href="{{route('manga',['manga'=>$manga->slug,'chapter'=>$chapter->id])}}" class="collection-item">{{$chapter->name}}</a>
                    @endforeach
            </ul>
        </div>
    </div>
    <!-- model chapter -->
    <div id="end-of-page"></div>
    <div id="disqus_thread"></div>
    <script src="{{asset('js/chapter.js')}}"></script>
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
        (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = 'http://kmanga-me.disqus.com/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>

</div>
</body>
</html>