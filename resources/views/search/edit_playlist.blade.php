@extends('layouts.app')

@section('content')
<div class="container">
  <div class="page-breadcrumbs">
    <h1 class="section-title">Edit Playlist</h1>
    {{ Form::open(['url' => url('edit_keywords/' . $playlist->pl_id), 'class'=>'submit-ajaxx', 'method'=>'POST']) }}
    {{ Form::hidden('pl_id', $playlist->pl_id, ['id'=>'pl_id']) }}
    {{ Form::hidden('hiddenField')}}
    {{ Form::close() }}
  </div>

  <div class="section">
    <div class="entry-meta">
			<ul class="list-inline">
				<li class="posted-by"><i class="fa fa-user"></i> by {{ $owner->name }}</li>
				<li class="publish-date"><i class="fa fa-clock-o"></i> {{ Carbon::parse($playlist->created_at)->diffForHumans() }}</li>
				<li class="views"><i class="fa fa-eye"></i> {{ $playlist->pl_view }} views</li>
			</ul>
		</div>
    <h3><span class="label label-info"><i class="fa fa-map-marker"></i> {{ $playlist->pl_location }}</span> <div class="inline_edit_title"><i class="fa fa-edit"></i> {{ $playlist->pl_title }}</div> </h3>
  </div>

  <div class="section">
    {{ Form::open(['url' => url('edit_keywords/' . $playlist->pl_id), 'class'=>'submit-ajaxx', 'method'=>'POST']) }}
    <div class="row">
      <div class="col-md-10 col-sm-8 col-xs-8">
        {{ Form::text('search_keys', $keys_string, ['id'=>'tags', 'class'=>'form-control']) }}
      </div>
      <div class="col-md-2 col-sm-4 col-xs-4">
        {{ Form::button(trans('form.btn_search'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
      </div>
    </div>
    {{ Form::close() }}
  </div>

  <div class="section">
    <!-- <h1><span class="label label-success">Destination: {{ $playlist->pl_location }}</span></h1> -->
    <div class="row">
      <div class="col-md-4 col-md-push-8">
        <!-- {{ Form::open(['url'=>url('playlist/edit'), 'action'=>'post']) }}
        {{ Form::hidden('pl_id', $playlist->pl_id, ['id'=>'pl_id']) }}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::textarea('pl_title', $playlist->pl_title, ['class'=>'form-control', 'rows'=>3]) }}
                </div>
            </div>
        </div>
        {{ Form::button( trans('form.btn_save_playlist'), ['type'=>'submit', 'class'=>'btn btn-primary']) }} -->
        <!-- <a href="{{ url('playlist/preview/' . $playlist->pl_id) }}">{{ Form::button( trans('form.btn_preview_playlist'), ['class'=>'btn btn-primary']) }}</a> -->
        <div id="selected_videos">
        </div>
        {{ Form::close() }}
      </div>
      <div class="col-md-8 col-md-pull-4">
            @foreach($resultsets as $key => $result)
            @if(!empty($result))
            <div class="scroll keyword_selection">
              <h5><span class="label label-info">{{ $key }}</span></h5>
                @foreach(array_chunk($result, 4) as $item_set)
                    <div class="row">
                    @foreach($item_set as $item)
                        <div class="col-md-3 col-sm-3 col-xs-3 select_video_thumbnail">
                            <a href="{{ url('search/preview/' . $item->id->videoId) }}" class="btn-modal">
                              <div class="play_image_container">
                                <img id="thumb{{ $item->id->videoId }}" src="{{ $item->snippet->thumbnails->medium->url }}" class="video_thumbnail @if (in_array($item->id->videoId, $selected)) selected_disable @endif" width="100%">
                                <div class="play_button"><i class="fa fa-play-circle-o"></i></div>
                              </div>
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
                <div class="load_more"><a href="{{ url('/edit_playlist/'.$playlist->pl_id.'/more?search_key=' . str_replace(' ', '+', $key)) }}">Load more</a></div>
            </div>
            @endif
            @endforeach
      </div>
    </div>
</div>
</div>
@endsection

@section('style')
<link href="{{ asset('css/jquery.tag-editor.css') }}" rel="stylesheet">
<style>
.tag-editor{padding: 10px 10px;}
</style>
@endsection

@section('script')
<script src="{{ asset('js/jquery.tag-editor.min.js') }}"></script>
<script src="{{ asset('/js/jquery.caret.min.js') }}"></script>
<script src="{{ asset('/js/jquery.jscroll.min.js') }}"></script>
<script>
$('.scroll').jscroll({
    autoTrigger: false,
    loadingHtml: '<span class="label label-default">Loading...</span>',
});

$(document).ready(function() {

  // setInterval ('cursorAnimation()', 600);

  var replaceWith = $('<input id="pl_title" name="pl_title" type="text" class="form-control" value="{{ $playlist->pl_title }}"/>'),
      connectWith = $('input[name="hiddenField"]');

  $('.inline_edit_title').inlineEdit(replaceWith, connectWith);

  getLatestSelected();

  $('#tags').tagEditor({
    maxTags: {{ config('playligo.max_keyword_tags') }},
  });

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

  $('body').on('keydown', '#pl_title', function (event) {
			// event.preventDefault();
      if(event.which == 13) {
        var pl_title = $(this).val();
        var pl_id = $('#pl_id').val();
        $.ajax({
  					url: '{{ url('playlist/edit') }}',
  					type: 'POST',
  					dataType: 'json',
  					data: {pl_title: pl_title, pl_id: pl_id, _token: "{{ csrf_token() }}"},
            success: function (data) {
              sweetAlert("Yay!", data.message, "success");
              // setTimeout(function () {
              //   if (data.redirect) {
              //     window.location = data.redirect;
              //   } else {
              //     location.reload();
              //   }
              // }, 2000);
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseText);
              var err = jQuery.parseJSON(xhr.responseText);
              var errStr = '';
              $.each(err, function(key, value) {
                errStr = errStr + value + "\n";
              });
              sweetAlert("Oops...", errStr, "error");
            }
  			});

  			return false;
      }
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

$.fn.inlineEdit = function(replaceWith, connectWith) {

    $(this).hover(function() {
        $(this).addClass('hover');
    }, function() {
        $(this).removeClass('hover');
    });

    $(this).click(function() {

        var elem = $(this);

        elem.hide();
        elem.after(replaceWith);
        replaceWith.focus();

        replaceWith.blur(function() {

            if ($(this).val() != "") {
                connectWith.val($(this).val()).change();
                elem.innerHTML = '<i class="fa fa-edit"></i> ' + $(this).val();
            }

            $(this).remove();
            elem.show();
        });
    });
};

// function cursorAnimation() {
//     $('#cursor').animate({
//         opacity: 0
//     }, 'fast', 'swing').animate({
//         opacity: 1
//     }, 'fast', 'swing');
// }
</script>
@endsection
