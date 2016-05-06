{{ trans('form.selected_videos') }} ({{ count($videos) }})
<div id="sort_list">
  <ul class="ui-sortable">
    @foreach ($videos as $video)
    <?php $video_snippet = unserialize($video->vc_snippet) ?>
    <li class="row selected_video" id="{{ $video->vc_id }}">
      <div class="col-md-4 col-sm-2 col-xs-4">
          <a href="{{ url('search/preview/' . $video->vc_id) }}" class="btn-modal"><img src="{{ $video_snippet->thumbnails->medium->url }}" class="img-rounded" width="100%"></a>
      </div>
      <div class="col-md-6 col-sm-8 col-xs-6">
          <div class="selected_video_title">{{ $video_snippet->title }}</div>
          <div class="selected_video_published"><i class="fa fa-clock-o"></i> {{ $video_snippet->publishedAt }}</div>
      </div>
      <div class="col-md-2 col-sm-2 col-xs-2">
          <a id="{{ $video->vc_id }}" class="remove_video_button" href="{{ url('search/selected/remove') }}"><i class="fa fa-times-circle fa-4"></i></a>
      </div>
    </li>
    @endforeach
  </ul>
</div>

<script>
// Sort selected videos
$("#sort_list ul").sortable({ opacity: 0.6, cursor: 'move',
	start: function(event, ui) {
				ui.item.startPos = ui.item.index();
		},
	update: function(event, ui) {
	var end_pos = ui.item.index();
	var start_pos = ui.item.startPos;
	var id = ui.item.attr("id");
	$.ajax({
					data: {start_pos:start_pos, end_pos:end_pos, id:id, _token: "{{ csrf_token() }}"},
					type: 'POST',
					url: '{{url('sort_selected')}}'
			});
}
});

</script>
