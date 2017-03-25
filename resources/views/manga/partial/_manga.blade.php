<!-- start poster -->
<div class="col s12 m6 l4">
    <div class="card padding-0 short-infomation">
        <div class="row row-poster">
            <div class="col s4 padding-0">
                <a title="{{$item->name}}" class="black-text" href="{{route('manga',['manga'=>$item->slug])}}" rel="contents">
                <img alt="Read latest {{$item->name}} manga online for free" title="Read latest {{$item->name}} manga online for free" class="manga-poster" src="{{$item->poster}}" />
                </a>
            </div>
            <div class="col s8 padding-0 ">
                <h3 class="title-h3"><a class="black-text" href="{{route('manga',['manga'=>$item->slug])}}" rel="contents">{{$item->name}}</a></h3>
                <span class="truncate">
                    @foreach($item->getCachedGenres() as $genre)
                    <a href="{{route('genre',['genre'=>$genre->slug])}}" class="chip small-tag">{{$genre->name}}</a>
                    @endforeach
                      </span>
                <p class="padding-0 margin-0">{{$item->getCacheLatestChap()}}</p>
                <p class="truncate padding-0 margin-0">Tác giả:
                    @foreach($item->getCachedAuthors() as $author)
                        <a title="{{$author->name}}" href="">{{$author->name}}</a>
                @endforeach
                </p>
                <p class="padding-0 margin-0">View :{{$item->view}}</p>
                <span class="badge green white-text past-timer">{{$item->updated_at->diffForHumans()}}</span>
            </div>
        </div>
        {{--<div class="card-reveal">--}}
            {{--<span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>--}}
            {{--<p>Here is some more information about this product that is only revealed once clicked on.</p>--}}
        {{--</div>--}}
    </div>
</div>

<!-- end poster -->