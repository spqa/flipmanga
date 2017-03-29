<!-- start poster -->
<div class="col s12 m6 l4 manga-wrapper">
    <div class="card padding-0 short-infomation">
        <div class="row row-poster">
            <div class="col s4 padding-0">
                <a title="{{$item->name}}" class="black-text" href="{{route('manga',['manga'=>$item->slug])}}" rel="contents">
                <img alt="Read latest {{$item->name}} manga online for free" title="Read latest {{$item->name}} manga online for free" class="manga-poster" src="{{$item->poster}}" />
                </a>
            </div>
            <div class="col s8 padding-0 ">

                <h3 class="title-h3 activator grey-text text-darken-4"><a class="black-text" href="{{route('manga',['manga'=>$item->slug])}}" rel="contents">{{$item->name}}</a><i class="material-icons right">more_vert</i></h3>

                <a href="{{route('manga.chapter',['manga'=>$item->slug,'chapter_slug'=>$item->getCacheLatestChap()->slug])}}" class="teal-text truncate padding-0 margin-0">Chapter : {{$item->getCacheLatestChap()->chapter_number}}</a>
                <p class="truncate padding-0 margin-0">Tác giả:
                    @foreach($item->getCachedAuthors() as $author)
                        <a title="{{$author->name}}" href="">{{$author->name}}</a>
                @endforeach
                </p>
                <p class="padding-0 margin-0">View :{{$item->view}}</p>
                <span class="badge green white-text past-timer">{{$item->updated_at->diffForHumans()}}</span>
            </div>
        </div>
        <div class="card-reveal">
            <span class="card-title grey-text text-darken-4"><i class="material-icons right">close</i></span>
            <span class="">
                    @foreach($item->getCachedGenres() as $genre)
                    <a href="{{route('genre',['genre'=>$genre->slug])}}" class="deep-orange lighten-3 chip small-tag">{{$genre->name}}</a>
                @endforeach
                      </span>
            <p>{{$item->description}}</p>
            <div class="center">
                <a class="teal-text" href="{{route('manga',['manga'=>$item->slug])}}">Đọc ngay</a>
            </div>
        </div>
    </div>
</div>