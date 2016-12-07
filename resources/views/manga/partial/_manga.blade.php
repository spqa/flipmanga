<!-- start poster -->
<div class="col s12 m6 l4">
    <div class="card-panel padding-0 short-infomation">
        <div class="row row-poster">
            <div class="col s4 padding-0">
                <img class="responsive-img" src="{{$item->poster}}" />
            </div>
            <div class="col s8 padding-0 ">
                <h3 class="title-h3">{{$item->name}}</h3>
                <span class="truncate"><div class="chip small-tag">harem</div>
                        <div class="chip small-tag">romance</div><div class="chip small-tag">romance</div>
                      </span>
                <p class="padding-0 margin-0">Chap: 50</p>
                <p class="truncate padding-0 margin-0">Author: {{$item->author}}</p>
                <p class="padding-0 margin-0">View :{{$item->view}}</p>
                <span class="badge green white-text past-timer">{{$item->updated_at->diffForHumans()}}</span>
            </div>
        </div>
    </div>
</div>
<!-- end poster -->