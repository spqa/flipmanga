<div class="item">
    <div class="card hoverable transparent z-depth-0">
        <div class="card-image waves-effect waves-block waves-light ">
            <a title="Read latest {{$item->name}} manga online for free" href="{{ route('manga',['slug'=>$item->slug]) }}"><img alt="Read latest {{$item->name}} manga online for free" title="Read latest {{$item->name}} manga online for free" width="161" height="214" src="{{$item->poster}}" class="activator">
            </a>
        </div>
        <div class="card-title card-title-img center-align">
            <a title="Read latest {{$item->name}} manga online for free" href="{{ route('manga',['slug'=>$item->slug]) }}" class="grey-text text-lighten-2 "><h3 class="title-h3-hot truncate">{{$item->name}}</h3></a>
            <a class="teal-text text-lighten-2 truncate" href="{{route('manga.chapter',['manga'=>$item->slug,'chapter_slug'=>$item->getCacheLatestChap()->slug])}}">{{$item->getCacheLatestChap()->name}}</a>
        </div>
        {{--<div class="card-reveal">--}}
        {{--<span class="card-title ">{{$item->name}}<i class="material-icons right">close</i></span>--}}
        {{--<p>{{$item->description}}</p>--}}
        {{--</div>--}}
    </div>
</div>