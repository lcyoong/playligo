<div class="post">
  <div class="post-content">
    <div class="row">
      <div class="col-md-2 col-sm-4 col-xs-4 text-center">
        <div class="image-cropper">
          <img class="rounded" src="{{ url($owner->avatar) }}" >
        </div>
        {{ $owner->name }}
      </div>
      <div class="col-md-10 col-sm-8 col-sx-8">
        <div class="entry-meta">
          <ul class="list-inline">
            <li class="publish-date"><a href="#"><i class="fa fa-clock-o"></i> {{ date(config('playligo.date_display_format'), strtotime($playlist->created_at)) }} </a></li>
            <li class="views"><a href="#"><i class="fa fa-eye"></i>{{ $playlist->pl_view }} views</a></li>
            <li class="publish-date"><div id="rating" class="plRating pull-left"></div> <div class="pull-left">{{ $playlist->pl_rating }} ({{ $playlist->pl_rating_count }} @lang('playlist.pl_rating_count'))</div> <div id="newRating" class="plNewRating pull-left" href="{{ url('playlist/rating/add') }}"></div></li>
          </ul>
        </div>
        <div class="entry-content">
          {{ $playlist->pl_description }}
        </div>
      </div>
    </div>
  </div>
</div>
