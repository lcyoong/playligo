@extends('layouts.app')

@section('content')
@if(auth()->check() && $playlist->pl_user == auth()->user()->id)
<div class="section action_section">
  <div class="action_section_inner">
    <div class="container">
      <h3>What's Next?</h3>
      <a href="{{ url('playlist/edit/' . $playlist->pl_id) }}">{{ Form::button(trans('form.btn_edit_playlist'), ['class'=>'btn btn-primary']) }}</a>&nbsp;&nbsp;
      <a href="{{ url('poll/add/'. $playlist->pl_id) }}" class="btn-modal">{{ Form::button(trans('form.btn_add_to_poll'), ['class'=>'btn btn-primary']) }}</a>&nbsp;&nbsp;
    </div>
  </div>
</div>
@endif

<div class="container">
  <div class="page-breadcrumbs">
    <h1 class="section-title">{{ $playlist->pl_title }}</h1>
  </div>

  <div class="section">
    <div class="entry-meta">
			<ul class="list-inline">
				<li class="posted-by"><i class="fa fa-user"></i> by <a href="#">{{ $owner->name }}</a></li>
				<li class="publish-date"><a href="#"><i class="fa fa-clock-o"></i> {{ $playlist->created_at }} </a></li>
				<li class="views"><a href="#"><i class="fa fa-eye"></i> {{ $playlist->pl_view }} views</a></li>
			</ul>
		</div>
  </div>

  <div class="row">
    <div class="col-md-8">
      <div class="video_wrapper">
        <div id="player"></div>
      </div>
      <div class="visible-sm-block visible-xs-block">
        <!-- @include('public.playlist.desc_column') -->
      </div>
    </div>
    <div class="col-md-4">
      <div class="section">
        <h5 class="section-title title">Playlist</h5>
        <ul class="list-group playlist-scroll">
          @foreach ($videos as $key => $video)
            <?php $video_snippet = unserialize($video->plv_snippet) ?>
            <li class="list-group-item">
              <a href="#" id="{{ $video->plv_video_id }}" vorder="{{ $key }}" class="play_video">
              <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="play_image_container">
                  <img src="{{ $video_snippet->thumbnails->medium->url }}" class="img-rounded" width="100%">
                  <div class="play_button"><i class="fa fa-play-circle-o"></i></div>
                </div>
              </div>
              <div class="col-md-8 col-sm-8 col-xs-8">
                  <div class="selected_video_title">{{ $video_snippet->title }}</div>
              </div>
            </div>
            </a>
          </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>

    <div class="row">
      <div class="col-md-8">
        <div class="hidden-sm hidden-xs">
          @include('public.playlist.desc_column')
        </div>
        <div class="fb-comments hidden-sm hidden-xs" data-href="{{ request()->url() }}" data-numposts="5" data-width="100%"></div>
      </div>

      <div class="col-md-4">
        <div class="section">
          <h5 class="section-title title">Latest Playlists</h5>
          <ul class="list-group poll_playlist_group">
            @foreach ($latest as $plmv)
            <?php $video_snippet = unserialize($plmv->plv_snippet) ?>
            <li class="list-group-item">
              <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-4">
                <div class="play_image_container">
                  <a href="{{ url('/public_playlist/' . $plmv->pl_id) }}"><img src="{{ $plmv->pl_thumb_path or asset(config('playligo.video_thumb_default')) }}" class="img-rounded" width="100%"></a>
                  <div class="play_button"><i class="fa fa-play-circle-o"></i></div>
                </div>
              </div>
              <div class="col-md-8 col-sm-8 col-xs-8">
                  <div class="selected_video_title">{{ $plmv->pl_title }}</div>
              </div>
            </div>
            </li>
            @endforeach
          </ul>
          <a href="{{ url('public_playlist') }}">@lang('form.show_more')</a>
          </div>

          <div class="section">
            <h5 class="section-title title">Recent Poll Votes</h5>
            <ul class="list-group">
            @foreach ($recent_votes as $vote)
            <li class="list-group-item">
              <div class="row">
              <div class="col-md-3 col-sm-3 col-xs-3">
                <div class="image-cropper">
                  <img class="rounded" src="{{ !empty($vote->avatar) ? $vote->avatar : asset(config('playligo.avatar_default')) }}" >
                </div>
              </div>
              <div class="col-md-9 col-sm-9 col-xs-9">
                {{ $vote->name }} voted for {{ $vote->pl_title }}
              </div>
            </div>
            </li>
            @endforeach
            </ul>
          </div>

        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="fb-comments visible-sm-block visible-xs-block" data-href="{{ request()->url() }}" data-numposts="5" data-width="100%"></div>
        </div>
      </div>

    </div>

<!-- </div> -->
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('css/fontawesome-circle-o.css') }}">
<link rel="stylesheet" href="{{ asset('css/fontawesome-stars-o.css') }}">
@endsection

@section('script')
<script src="https://cdn.rawgit.com/vast-engineering/jquery-popup-overlay/1.7.13/jquery.popupoverlay.js"></script>
<script src="{{ asset('js/jquery.barrating.min.js') }}"></script>
<script type="text/javascript">
   $(function() {

     ratingEnable({{ $playlist->pl_rating }});

      $('.newPlRating').barrating({
        theme: 'fontawesome-circle-o',
        initialRating: {{ $my_rating }},
        showSelectedRating: true,
        onSelect: function(value, text, event) {
            if (typeof(event) !== 'undefined') {
              $('#ratingPopUp').popup('hide');
              $.ajax({
        					url: "{{ url('playlist/rating/add') }}",
        					type: 'POST',
        					dataType: 'json',
        					data: {plr_playlist: {{ $playlist->pl_id }}, plr_rating: value, _token: "{{ csrf_token() }}"},
        					success: function (data) {
                    sweetAlert("Yay!", data.message, "success");
                    $('.plRating').barrating('destroy');
                    ratingEnable(data.rating);
        					}
        			});
            } else {
              // rating was selected programmatically
              // by calling `set` method
            }
          }
      });

   });

   function ratingEnable(rating) {
     $('.plRating').barrating('show', {
       theme: 'fontawesome-circle-o',
       initialRating: rating,
       showSelectedRating: true,
       readonly: true,
     });

   }
</script>

<!--FB comment plugin-->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6&appId=1070932692967173";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<!--FB comment plugin ends-->

<!-- <script src="http://www.youtube.com/player_api"></script> -->
<script>

    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    var player;
    function onYouTubeIframeAPIReady() {
      player = new YT.Player('player', {
        playerVars: { 'autoplay': 1, 'controls': 2, 'showinfo': 1},
        events: {
          'onReady': onPlayerReady,
          'onStateChange': onPlayerStateChange
        }
      });
    }


    function onPlayerReady(event) {
      <?php $vid = [] ?>
      @foreach ($videos as $item)
      <?php $vid[] = $item->plv_video_id; ?>
      @endforeach
      var videos = {!! json_encode($vid) !!};
      event.target.loadPlaylist(videos);
      event.target.playVideo();
    }

    var done = false;
    function onPlayerStateChange(event) {
      if (event.data == YT.PlayerState.PLAYING && !done) {
        // setTimeout(stopVideo, 6000);
        done = true;
      }
    }

    function stopVideo() {
      player.stopVideo();
    }

    function loadVideo() {
      player.loadVideoById("bHQqvYy5KYo", 5, "large");
    }

$(document).ready(function() {
  // getLatestSelected();

  $('#ratingPopUp').popup({
    transition: 'all 0.3s',
    scrolllock: true,
    blur: true,
    openelement: '.ratingPopUp_open',
    type: 'tooltip',
    offsettop: -60,
  });

  $('body').on('click', '.play_video', function (event) {
			event.preventDefault();
      var id = $(this).attr('id');
      var vorder = $(this).attr('vorder');
      player.playVideoAt(vorder);

			return false;
	});

});


function getLatestSelected()
{
  $.ajax({
      url: "{{ url('/search/load_selected') }}",
      type: 'GET',
      // dataType: 'json',
      // data: {_token: "{{ csrf_token() }}"},
      // success: function (data) {
      //     // Update selected videos section
      //     // $('#selected_videos').hide().fadeIn('fast');
      //     $('#selected_videos').html();
      // }
    }).done(function( data ) {
      $('#selected_videos').html(data);
      // console.log( data );
  });

}

</script>
@endsection

@section('meta')
  @if ($playlist->pl_rating < config('playligo.min_rating_show_index'))
  <!-- <meta name="robots" content="noindex, follow"> -->
  @endif
	<!-- <meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" /> -->
@endsection
