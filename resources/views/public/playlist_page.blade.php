@extends('layouts.app')

@section('meta')
<meta property="fb:app_id" content="{{ env('FACEBOOK_CLIENT_ID') }}" />
@endsection

@section('content')
<div class="container">
  <div class="page-breadcrumbs">
    <h1 class="section-title">{{ $playlist->pl_title }}</h1>
  </div>
  <div class="section">
    <!-- <div class="fb-like" data-href="{{ Request::url() }}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
    <div class="pull-right">
      <a class="btn btn-sm btn-default btn-transparent--border btn-hoverWhite ct-u-text--white" href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}" target=_blank><i class="fa fa-facebook"></i></a>
      <a class="btn btn-sm btn-default btn-transparent--border btn-hoverWhite ct-u-text--white" href="http://twitter.com/home?status={{ Request::url() }}" target=_blank><i class="fa fa-twitter"></i></a>
    </div> -->
  </div>
  <div class="row">
    <div class="col-md-8">
      <div class="video_wrapper">
        <div id="player"></div>
      </div>
      <div class="visible-sm-block visible-xs-block">
        @include('public.playlist.desc_column')
      </div>
    </div>
    <div class="col-md-4">
      <div class="section">
        <h5 class="section-title title">Playlist</h5>
        <ul class="list-group playlist-scroll">
          @foreach ($videos as $key => $video)
            <?php $video_snippet = unserialize($video->vc_snippet) ?>
            <li class="list-group-item">
              <div class="row">
              <div class="col-md-4 col-sm-4 col-xs-4">
                  <!-- <a href="{{ url('search/preview/' . $video->vc_id) }}" class="btn-modal"><img src="{{ $video_snippet->thumbnails->medium->url }}" class="img-rounded" width="100%"></a> -->
                  <a href="#" id="{{ $video->vc_id }}" vorder="{{ $key }}" class="play_video"><img src="{{ $video_snippet->thumbnails->medium->url }}" class="img-rounded" width="100%"></a>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="selected_video_title">{{ $video_snippet->title }}</div>
              </div>
            </div>
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
          <h5 class="section-title title">Top Playlists</h5>
          @foreach ($mostViewed as $plmv)
          <?php $video_snippet = unserialize($plmv->vc_snippet) ?>
          <li class="list-group-item">
            <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4">
                <!-- <a href="{{ url('search/preview/' . $video->vc_id) }}" class="btn-modal"><img src="{{ $video_snippet->thumbnails->medium->url }}" class="img-rounded" width="100%"></a> -->
                <a href="{{ url('/public_playlist/' . $plmv->pl_id) }}"><img src="{{ $video_snippet->thumbnails->medium->url }}" class="img-rounded" width="100%"></a>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">
                <div class="selected_video_title">{{ $plmv->pl_title }}</div>
            </div>
          </div>
          </li>
          @endforeach
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="fb-comments visible-sm-block visible-xs-block" data-href="{{ request()->url() }}" data-numposts="5" data-width="100%"></div>
      </div>
    </div>
</div>
@endsection

@section('script')
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

<script src="http://www.youtube.com/player_api"></script>
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
      <?php $vid[] = $item->vc_id; ?>
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

</script>
<script>
$(document).ready(function() {
  // getLatestSelected();

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


$(function () {

  $(".plRating").rateYo({
    starWidth: "18px",
    rating    : {{ $playlist->pl_rating }},
    readOnly: true
  });

  $(".plNewRating").rateYo({
    starWidth: "18px",
    halfStar: true,
  }).on("rateyo.set", function (e, data) {
    var rating = data.rating;
    $.ajax({
        url: $(this).attr('href'),
        type: 'POST',
        dataType: 'json',
        data: {plr_playlist: {{ $playlist->pl_id }}, plr_rating:rating, _token: "{{ csrf_token() }}"},
        success: function (data) {
            location.reload();
        }
    });
  });

});
</script>
@endsection

@section('meta')
  <meta property="og:url"           content="{{ Request::url() }}" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="{{ $playlist->pl_title }}" />
	<meta property="og:description"   content="{{ $playlist->pl_description }}" />
	<!-- <meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" /> -->
@endsection
