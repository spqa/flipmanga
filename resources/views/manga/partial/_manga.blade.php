<!-- start poster -->
<div class="col s12 m6 l4">
    <div class="card-panel padding-0 short-infomation">
        <div class="row row-poster">
            <div class="col s4 padding-0">
                <a title="{{$item->name}}" class="black-text" href="{{route('manga',['manga'=>$item->slug])}}" rel="contents">
                <img alt="Read latest {{$item->name}} manga online for free" title="Read latest {{$item->name}} manga online for free" class="manga-poster" src="{{'http://images1-focus-opensocial.googleusercontent.com/gadgets/proxy?container=focus&gadget=a&no_expand=1&resize_h=0&rewriteMime=image%2F*&url='.$item->poster}}" />
                </a>
            </div>
            <div class="col s8 padding-0 ">
                <h3 class="title-h3"><a class="black-text" href="{{route('manga',['manga'=>$item->slug])}}" rel="contents">{{$item->name}}</a></h3>
                <span class="truncate">
                    @foreach($item->getCachedGenres() as $genre)
                    <a href="{{route('genre',['genre'=>$genre->slug])}}" class="chip small-tag">{{$genre->name}}</a>
                    @endforeach
                      </span>
                <p class="padding-0 margin-0">Chap: {{$item->getCacheLatestChap()}}</p>
                <p class="truncate padding-0 margin-0">Author:
                    @foreach($item->getCachedAuthors() as $author)
                        <a title="{{$author->name}}" href="">{{$author->name}}</a>
                @endforeach
                </p>
                <p class="padding-0 margin-0">View :{{$item->view}}</p>
                <span class="badge green white-text past-timer">{{$item->updated_at->diffForHumans()}}</span>
            </div>
        </div>
    </div>
</div>

<!-- end poster -->