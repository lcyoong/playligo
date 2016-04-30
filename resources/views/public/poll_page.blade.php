@extends('layouts.app')

@section('content')
{{ Form::open(['url'=> url(''), 'method'=>'post']) }}
<div class="container">
    <div class="page-breadcrumbs">
      <h1 class="section-title">{{ $poll->pol_title }}</h1>
    </div>
    <div class="section">
      <!-- <div class="fb-like" data-href="{{ Request::url() }}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
      <div class="pull-right">
        <a class="btn btn-sm btn-default btn-transparent--border btn-hoverWhite ct-u-text--white" href="https://www.facebook.com/sharer/sharer.php?u={{ Request::url() }}" target=_blank><i class="fa fa-facebook"></i></a>
        <a class="btn btn-sm btn-default btn-transparent--border btn-hoverWhite ct-u-text--white" href="http://twitter.com/home?status={{ Request::url() }}" target=_blank><i class="fa fa-twitter"></i></a>
      </div> -->
    </div>

    <h4>Vote for your favorite destination or playlist by  clicking on the “love” button…</h4>
    <div class="row">
      <div class="col-md-8">
        <ul class="list-group">
        @foreach($poll->playlists as $playlist)
          <?php $snippet = unserialize($playlist->vc_snippet); ?>
          <li class="list-group-item">
            <div class="row playlist_videos_row">
              <div class="col-md-2 text-center">
                <div class="vote_count">{{ number_format($playlist->polp_vote) }}</div>
                <a href="{{ url('/pollplaylist/'.$playlist->polp_id.'/vote') }}" class="vote_playlist">{{ Form::button('<i class="fa fa-heart fa-1"></i>', ['class'=>'btn btn-default']) }}</a>
              </div>
              <!-- <div class="col-md-2"><a href="{{ url('search/preview/' . $playlist->vc_id) }}" class="btn-modal"><img src="{{ $snippet->thumbnails->medium->url }}" class="img-rounded" width="100%"></a></div> -->
              <div class="col-md-10" style="font-size: 1.2em;"><a href="{{ url('load_playlist/' . $playlist->pl_id) }}" class="load_playlist">{{ $playlist->pl_title  }}</a></div>
            </div>
          </li>
        @endforeach
        </ul>
      </div>
      <div class="col-md-4">
        <div id="playlist_videos">
        </div>
      </div>
    </div>
</div>
{{ Form::close() }}
@endsection

@section('script')
<script>

$(document).ready(function() {
	$('body').on('click', '.load_playlist', function (event) {
			event.preventDefault();
			$.ajax({
					url: $(this).attr('href'),
					type: 'GET',
			}).done(function( data ) {
        $('#playlist_videos').html(data);
    });
			return false;
	});

  $('body').on('click', '.vote_playlist', function (event) {
			event.preventDefault();
      $.ajax({
          url: $(this).attr('href'),
          type: 'POST',
          dataType: 'json',
          data: {_token: $("input[name='_token']").val()},
          success: function (data) {
              // $('#basicModal').find('.modal-content').html('');
              // $('#basicModal').modal('show');
              // $('#basicModal').find('.modal-content').load($(this).attr('href'));
              location.reload();
          },
          error: function(data){
            $('#basicModal').find('.modal-content').html('');
            $('#basicModal').modal('show');
            $('#basicModal').find('.modal-content').html(data.responseText);
    			}
      });
			return false;
	});
});

</script>
@endsection

@section('meta')
  <meta property="og:url"           content="{{ Request::url() }}" />
	<meta property="og:type"          content="website" />
	<meta property="og:title"         content="{{ $poll->pol_title }}" />
	<meta property="og:description"   content="{{ $poll->pol_description }}" />
	<!-- <meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" /> -->
@endsection
