<a href="{{route('manga',['manga'=>$item->slug])}}" title="{{$item->name}}">
<div class="col s6 m3 l2">
    <div class="card">
        <div class="card-image">
            <img class="img-suggestion" alt="Read latest {{$item->name}} manga online for free" title="Read latest {{$item->name}} manga online for free" src="{{$item->poster}}">
            <span class="card-title center no-padding">{{$item->name}}</span>
        </div>
    </div>
</div>
</a>