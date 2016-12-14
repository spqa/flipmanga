<div class="item">
    <div class="card hoverable">
        <div class="card-image waves-effect waves-block waves-light ">
            <a href="{{ '/manga/'.$item->slug }}"><img width="161" height="214" src="{{$item->poster}}" class="activator">
            </a>
        </div>
        <div class="card-title card-title-img center-align">
            <a href="{{ '/manga/'.$item->slug }}" class="grey-text darken-4 truncate">{{$item->name}}</a>
            <a href="#">Chap {{$item->getCacheLatestChap()}}</a>
        </div>
        {{--<div class="card-reveal">--}}
            {{--<span class="card-title ">{{$item->name}}<i class="material-icons right">close</i></span>--}}
            {{--<p>{{$item->description}}</p>--}}
        {{--</div>--}}
    </div>
</div>