@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            {{ Form::open(['url'=>'search', 'action'=>'post']) }}
            @foreach(array_chunk($result, 4) as $item_set)
                <div class="row">
                @foreach($item_set as $item)
                    <div class="col-md-3 col-sm-3 select_video_thumbnail">
                        <a href="{{ url('search/preview/' . $item->id->videoId) }}" class="btn-modal"><img id="thumb{{ $item->id->videoId }}" src="{{ $item->snippet->thumbnails->medium->url }}" class="img-rounded @if (key_exists($item->id->videoId, $selected)) selected_disable @endif" width="100%"></a>
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
            {{ Form::close() }}
        </div>

        <div class="col-md-4" id="selected_videos">
            {{ trans('form.selected_videos') }} ({{ count($videos) }})
            @foreach ($videos as $video)
                <?php $video_snippet = unserialize($video->vc_snippet) ?>
                <div class="row selected_video">
                    <div class="col-md-4 col-sm-2">
                        <a href="{{ url('search/preview/' . $video->vc_id) }}" class="btn-modal"><img src="{{ $video_snippet->thumbnails->medium->url }}" class="img-rounded" width="100%"></a>
                    </div>
                    <div class="col-md-6 col-sm-8">
                        <div class="selected_video_title">{{ $video_snippet->title }}</div>
                        <div class="selected_video_published"><i class="fa fa-clock-o"></i> {{ $video_snippet->publishedAt }}</div>
                    </div>
                    <div class="col-md-2 col-sm-2">
                        <a id="{{ $video->vc_id }}" class="remove_video_button" href="{{ url('search/selected/remove') }}"><i class="fa fa-times-circle fa-4"></i></a>
                    </div>
                </div>
            @endforeach
            {{ Form::open(['url'=>url('playlist/create'), 'action'=>'post']) }}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::text('pl_description', '', ['class'=>'form-control', 'placeholder'=> trans('form.playlist_title_placeholder')]) }}
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
$(document).ready(function() {
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

              // Update clicked video link
              $('#' + id).html('<i class="fa fa-check-circle fa-3"></i> Added');
              $('#' + id).attr('href', '#');
              $('#' + id).removeClass('add_video_button');
              $('#thumb' + id).addClass('selected_disable');
              location.reload();
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

              // Update clicked video link
              $('#' + id).addClass('add_video_button');
              $('#thumb' + id).removeClass('selected_disable');
              location.reload();
					}
			});

			return false;
	});

});

function getLatestSelected()
{
}

@endsection
