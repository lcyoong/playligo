@foreach($mostVoted->chunk(4) as $mv_set)
  <div class="row">
    @foreach($mv_set as $mv_item)
    <div class="col-md-3 col-sm-6 col-xs-6">
      <div class="post poll-thumbnail medium-post">
        <div class="entry-header">
          <div class="notransition">
            <div class="image-cropper">
              <img class="rounded" src="{{ !empty($mv_item->avatar) ? $mv_item->avatar : asset(config('playligo.avatar_default')) }}" >
            </div>
            <div class="avatar-text">
              {{ $mv_item->name }}
            </div>
          </div>
        </div>
        <div class="post-content">
          <div class="entry-meta">
            <ul class="list-inline">
              <li class="views"><i class="fa fa-eye"></i> {{ $mv_item->pol_view }} views</li>
              <li class="loves"><i class="fa fa-thumbs-o-up"></i> {{ $mv_item->pol_votes }} votes</li>
            </ul>
          </div>
          <h2 class="entry-title">
            <a href="{{ url('public_poll/' . $mv_item->pol_id) }}">{{ str_limit($mv_item->pol_title, 100) }}</a>
          </h2>
        </div>
      </div>
    </div>
    @endforeach
  </div>
@endforeach
<div class="load_more"><a href="{{ url('public_poll/mostvoted/more?page=' . ($page + 1)) }}">Load more</a></div>
<script>
$(document).ready(function() {

  ratingEnable();

});
</script>
