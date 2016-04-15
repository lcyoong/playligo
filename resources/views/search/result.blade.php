@extends('layouts.app')

@section('content')
<div class="container">
    <h1><span class="label label-success">Destination: {{ $location }}</span></h1>
    <div class="row">
        <div class="col-md-8">
            {{ Form::open(['url'=>'search', 'action'=>'post']) }}
            <div class="scroll">
            @foreach(array_chunk($result, 4) as $item_set)
                <div class="row">
                @foreach($item_set as $item)
                    <div class="col-md-3 col-sm-3 col-xs-3 select_video_thumbnail">
                        <a href="{{ url('search/preview/' . $item->id->videoId) }}" class="btn-modal"><img id="thumb{{ $item->id->videoId }}" src="{{ $item->snippet->thumbnails->medium->url }}" class="img-rounded @if (in_array($item->id->videoId, $selected)) selected_disable @endif" width="100%"></a>
                        <div class="select_video_control">
                            @if (key_exists($item->id->videoId, $selected))
                                <a href="#"><i class="fa fa-check-circle fa-3"></i> Added</a>
                            @else
                                <a id="{{ $item->id->videoId }}" href="{{ url('search/add_video') }}" class="add_video_button"><i class="fa fa-plus-circle fa-3"></i> {{ trans('form.add_to_playlist') }}</a>
                            @endif
                        </div>
                    </div>
                @endforeach
                </div>
            @endforeach
            <a href="{{ url('/results/more?' . Request::getQueryString()) }}">{{ Form::button(trans('form.btn_load_more'), ['type'=>'button', 'class'=>'form-control btn btn-primary']) }}</a>
            </div>
            {{ Form::close() }}
        </div>

        <div class="col-md-4">
          {{ Form::open(['url'=>url('playlist/create'), 'action'=>'post']) }}
          <div id="selected_videos">
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      {{ Form::label('pl_title', trans('playlist.pl_title'), ['class'=>'control-label']) }}
                      {{ Form::text('pl_title', $default_playlist_title, ['class'=>'form-control']) }}
                  </div>
              </div>
          </div>
          {{ Form::button( trans('form.btn_create_playllist'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
          {{ Form::close() }}
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('/js/jquery.jscroll.min.js') }}"></script>
<script>
$('.scroll').jscroll({
    autoTrigger: false,
    loadingHtml: '<span class="label label-default">Loading...</span>',
});

$(document).ready(function() {
  getLatestSelected();

	$('body').on('click', '.add_video_button', function (event) {
			event.preventDefault();
      var id = $(this).attr('id');
			$.ajax({
					url: $(this).attr('href'),
					type: 'POST',
					dataType: 'json',
					data: {id: id, _token: "{{ csrf_token() }}"},
					success: function (data) {
              // Update selected videos section
              $('#selected_videos').hide().fadeIn('fast');
              getLatestSelected();

              // Update clicked video link
              $('#' + id).html('<i class="fa fa-check-circle fa-3"></i> Added');
              $('#' + id).attr('href', '#');
              $('#' + id).removeClass('add_video_button');
              $('#thumb' + id).addClass('selected_disable');
              // location.reload();
					}
			});

			return false;
	});

  // Remove video from selected list
  $('body').on('click', '.remove_video_button', function (event) {
			event.preventDefault();
      var id = $(this).attr('id');
			$.ajax({
					url: $(this).attr('href'),
					type: 'POST',
					dataType: 'json',
					data: {id: id, _token: "{{ csrf_token() }}"},
					success: function (data) {
              // Update selected videos section
              $('#selected_videos').hide().fadeIn('fast');
              getLatestSelected();

              // Update clicked video link
              $('#' + id).html('<i class="fa fa-check-circle fa-3"></i> Add to playlist');
              $('#' + id).addClass('add_video_button');
              $('#' + id).attr('href', "{{ url('search/add_video') }}");
              $('#thumb' + id).removeClass('selected_disable');
              // location.reload();
					}
			});

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
