@extends('layouts.app')

@section('content')
<div class="container">
    <h1><span class="label label-success">Destination: {{ $playlist->pl_location }}</span></h1>
    <div class="row">
        <div class="col-md-8">
              @foreach($resultsets as $key => $result)
              @if(!empty($result))
              <div class="scroll">
                <h5><span class="label label-danger">{{ $key }}</span></h5>
                  @foreach(array_chunk($result, 4) as $item_set)
                      <div class="row">
                      @foreach($item_set as $item)
                          <div class="col-md-3 col-sm-3 col-xs-3 select_video_thumbnail">
                              <a href="{{ url('search/preview/' . $item->id->videoId) }}" class="btn-modal"><img id="thumb{{ $item->id->videoId }}" src="{{ $item->snippet->thumbnails->medium->url }}" class="video_thumbnail @if (in_array($item->id->videoId, $selected)) selected_disable @endif" width="100%">
                                <div class="description"><div class='description_content'>{{ $item->snippet->title }}</div></div>
                              </a>
                              <div class="select_video_control">
                                  @if (in_array($item->id->videoId, $selected))
                                      <a href="#"><i class="fa fa-check-circle fa-3"></i> Added</a>
                                  @else
                                      <a id="{{ $item->id->videoId }}" href="{{ url('playlist/video/add') }}" class="add_video_button"><i class="fa fa-plus-circle fa-3"></i> {{ trans('form.add_to_playlist') }}</a>
                                  @endif
                              </div>
                          </div>
                      @endforeach
                      </div>
                  @endforeach
                  <a href="{{ url('/edit_playlist/'.$playlist->pl_id.'/more?search_key=' . str_replace(' ', '+', $key)) }}">{{ Form::button(trans('form.btn_load_more'), ['type'=>'button', 'class'=>'form-control btn btn-primary']) }}</a>
              </div>
              @endif
              @endforeach
        </div>

        <div class="col-md-4">
          {{ Form::open(['url'=>url('playlist/edit'), 'action'=>'post']) }}
          {{ Form::hidden('pl_id', $playlist->pl_id, ['id'=>'pl_id']) }}
          <div id="selected_videos">
          </div>
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      {{ Form::label('pl_title', trans('playlist.pl_title'), ['class'=>'control-label']) }}
                      {{ Form::text('pl_title', $playlist->pl_title, ['class'=>'form-control']) }}
                  </div>
              </div>
          </div>
          {{ Form::button( trans('form.btn_save_playlist'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
          <a href="{{ url('playlist/preview/' . $playlist->pl_id) }}">{{ Form::button( trans('form.btn_preview_playlist'), ['class'=>'btn btn-primary']) }}</a>
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
      var pl_id = $('#pl_id').val();
			$.ajax({
					url: $(this).attr('href'),
					type: 'POST',
					dataType: 'json',
					data: {pl_id: pl_id, id: id, _token: "{{ csrf_token() }}"},
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
      var plv_id = $(this).attr('plv_id');
      var id = $(this).attr('id');
			$.ajax({
					url: $(this).attr('href'),
					type: 'POST',
					dataType: 'json',
					data: {plv_id: plv_id, _token: "{{ csrf_token() }}"},
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

  // Video thumbs description hover
  $(document).on({
    mouseenter: function(){
        $('div.description').css('width', $('.video_thumbnail').width());

        $('div.description').css('height', $('.video_thumbnail').height());

        $(this).children('.description').stop().fadeTo(500, 0.7);
    },
    mouseleave: function(){
        $(this).children('.description').stop().fadeTo(500, 0);
    }
  }, '.select_video_thumbnail a');

});


function getLatestSelected()
{
  $.ajax({
      url: "{{ url('/edit_playlist/load_selected/' . $playlist->pl_id) }}",
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
