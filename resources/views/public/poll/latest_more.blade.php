@foreach($latest->chunk(4) as $latest_set)
  <div class="row">
    @foreach($latest_set as $latest_item)
    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="post poll-thumbnail medium-post">
        <div class="entry-header">
          <div class="notransition">
            <div class="image-cropper">
              <img class="rounded" src="{{ !empty($latest_item->avatar) ? $latest_item->avatar : asset(config('playligo.avatar_default')) }}" >
            </div>
            <div class="avatar-text">
              {{ $latest_item->name }}
            </div>
          </div>
        </div>
        <div class="post-content">
          <div class="entry-meta">
            <ul class="list-inline">
              <li class="views"><i class="fa fa-eye"></i> {{ $latest_item->pol_view }} views</li>
              <li class="loves"><i class="fa fa-thumbs-o-up"></i> {{ $latest_item->pol_votes }} votes</li>
            </ul>
          </div>
          <h2 class="entry-title">
            <a href="{{ url('public_poll/' . $latest_item->pol_id) }}">{{ str_limit($latest_item->pol_title, 100) }}</a>
          </h2>
        </div>
      </div>
    </div>
    @endforeach
  </div>
@endforeach
<div class="load_more"><a href="{{ url('public_poll/latest/more?page=' . ($page + 1)) }}">Load more</a></div>

<script>
$(document).ready(function() {

  ratingEnable();

});
</script>
