@extends('layouts.modal')

@section('content')
<h4>{{ $playlist->pl_title }}</h4>
<div class="row">
    <div class="col-md-12">
      <div class="video_wrapper">
        <div id="player"></div>
      </div>
    </div>
</div>
@endsection

@section('script')
<script src="http://www.youtube.com/player_api"></script>
<script>
$(document).ready(function() {

  var tag = document.createElement('script');
  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

  $("#basicModal").on('shown.bs.modal', function() {
    player.playVideo();
  });

  $("#basicModal").on('hidden.bs.modal', function() {
    player.stopVideo();
  });
});

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

// var tag = document.createElement('script');
// tag.src = "https://www.youtube.com/iframe_api";
// var firstScriptTag = document.getElementsByTagName('script')[0];
// firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
// var player;
// function onYouTubeIframeAPIReady() {
//   player = new YT.Player('player', {
//     playerVars: { 'autoplay': 1, 'controls': 2, 'showinfo': 1},
//     events: {
//       'onReady': onPlayerReady,
//       'onStateChange': onPlayerStateChange
//     }
//   });
// }


function onPlayerReady(event) {
  alert('ss');
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

// function loadVideo() {
//   player.loadVideoById("bHQqvYy5KYo", 5, "large");
// }

</script>
@endsection
