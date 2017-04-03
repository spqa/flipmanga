<h2><a class="black-text" href="{{route('meme.index',['slug'=>$meme->slug])}}">{{$meme->title}}</a></h2>
<div class="card z-depth-0">
    <div class="card-image">
        <img src="{{$meme->image}}">
    </div>
    <div class="card-content">
        <span class="btn grey-text transparent z-depth-0 right"><i class="material-icons left">remove_red_eye</i><span>{{$meme->view_count}}</span></span>
        <a href="/meme-anh-che/{{$meme->slug}}#comment" class="btn grey-text transparent z-depth-0 right"><i class="material-icons left">comment</i><div class="fb-comments-count inline" data-href="/meme-anh-che/{{$meme->slug}}">1</div></a>
        <div class="fb-like" data-href="/meme-anh-che/{{$meme->slug}}" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
    </div>

</div>