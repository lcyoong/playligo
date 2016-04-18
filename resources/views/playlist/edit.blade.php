@extends('layouts.app')

@section('content')
<div class="container">
		<div class="page-header page-heading">
				<h2><i class="fa fa-edit"></i> {{ trans('playlist.edit_title') }} - {{$playlist->pl_title}}
					<a href="{{ url('playlist') }}" class="btn btn-default  pull-right"><span class="fa fa-angle-double-left"></span> @lang('form.back_to_list')</a></h2>
		</div>
		{{ Form::open(['url'=>url('playlist/edit'), 'method'=>'post', 'class'=>'form-horizontal']) }}
		{{ Form::hidden('pl_id', $playlist->pl_id, ['id'=>'pl_id']) }}
		<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="form-group">
	          	{{ Form::label('pl_title', trans('playlist.pl_title'), ['class'=>'col-md-4 control-label']) }}
	          	<div class="col-md-8">
	          		{{ Form::text('pl_title', $playlist->pl_title, ['class'=>'form-control']) }}
	          	</div>
          	</div>
					</div>
					<div class="row">
						<div class="form-group">
	          	{{ Form::label('pl_description', trans('playlist.pl_description'), ['class'=>'col-md-4 control-label']) }}
	          	<div class="col-md-8">
	          		{{ Form::textarea('pl_description', $playlist->pl_description, ['class'=>'form-control', 'rows'=>5]) }}
	          	</div>
          	</div>
					</div>
					<div class="row">
						<div class="form-group">
							{{ Form::label('pl_title', trans('form.created_at'), ['class'=>'col-md-4 control-label']) }}
							{{ Form::label('pl_title', $playlist->created_at, ['class'=>'col-md-8 control-label']) }}
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							{{ Form::label('pl_title', trans('form.updated_at'), ['class'=>'col-md-4 control-label']) }}
							{{ Form::label('pl_title', $playlist->updated_at, ['class'=>'col-md-8 control-label']) }}
						</div>
					</div>
					<div class="form-group">
							{{ Form::button(trans('form.btn_submit'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
					</div>
				</div>
				<div class="col-md-6">
					<div id="sort_list">
						<ul class="ui-sortable list-group">
							@foreach($playlist->videos as $video)
							<?php $video_snippet = unserialize($video->cache->vc_snippet) ?>
							<li class="list-group-item" id="{{ $video->plv_id }}">
								<div class="row">
									<div class="col-md-2">
											<a href="{{ url('search/preview/' . $video->cache->vc_id) }}" class="btn-modal"><img src="{{ $video_snippet->thumbnails->medium->url }}" class="img-rounded" width="100%"></a>
									</div>
									<div class="col-md-8">
											{{ $video_snippet->title }}
									</div>
									<div class="col-md-2">
											<i class="fa fa-sort"></i>
											<a href="{{ url('playlist/video/' . $video->plv_id . '/delete') }}" class="btn-modal"><i class="fa fa-times-circle"></i></a>
									</div>
								</div>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
		</div>
		{{ Form::close() }}
</div>
@endsection

@section('script')
<script>
$("#sort_list ul").sortable({ opacity: 0.6, cursor: 'move',
	start: function(event, ui) {
				ui.item.startPos = ui.item.index();
		},
	update: function(event, ui) {
	var end_pos = ui.item.index() + 1;
	var start_pos = ui.item.startPos + 1;
	var pl_id = $('#pl_id').val();
	var id = ui.item.attr("id");
	$.ajax({
					data: {start_pos:start_pos, end_pos:end_pos, pl_id:pl_id, id:id, _token: "{{ csrf_token() }}"},
					type: 'POST',
					url: '{{url('playlist/sort_item')}}'
			});
}
});
</script>
@endsection
