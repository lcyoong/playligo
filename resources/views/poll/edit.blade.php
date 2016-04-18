@extends('layouts.app')

@section('content')
<div class="container">
		<div class="page-header page-heading">
				<h2><i class="fa fa-edit"></i> {{ trans('poll.edit_title') }} - {{$poll->pol_title}}
					<a href="{{ url('poll') }}" class="btn btn-default pull-right"><span class="fa fa-angle-double-left"></span> @lang('form.back_to_list')</a></h2>
		</div>
		{{ Form::open(['url'=>url('poll/edit'), 'method'=>'post', 'class'=>'form-horizontal']) }}
		{{ Form::hidden('pol_id', $poll->pol_id, ['id'=>'pol_id']) }}
		<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="form-group">
	          	{{ Form::label('pol_title', trans('poll.pol_title'), ['class'=>'col-md-4 control-label']) }}
	          	<div class="col-md-8">
	          		{{ Form::text('pol_title', $poll->pol_title, ['class'=>'form-control']) }}
	          	</div>
          	</div>
					</div>
					<div class="row">
						<div class="form-group">
	          	{{ Form::label('pol_description', trans('poll.pol_description'), ['class'=>'col-md-4 control-label']) }}
	          	<div class="col-md-8">
	          		{{ Form::textarea('pol_description', $poll->pol_description, ['class'=>'form-control', 'rows'=>5]) }}
	          	</div>
          	</div>
					</div>
					<div class="row">
						<div class="form-group">
							{{ Form::label('pol_description', trans('form.created_at'), ['class'=>'col-md-4 control-label']) }}
							{{ Form::label('pol_description', $poll->created_at, ['class'=>'col-md-8 control-label']) }}
						</div>
					</div>
					<div class="row">
						<div class="form-group">
							{{ Form::label('pol_description', trans('form.updated_at'), ['class'=>'col-md-4 control-label']) }}
							{{ Form::label('pol_description', $poll->updated_at, ['class'=>'col-md-8 control-label']) }}
						</div>
					</div>
					<div class="form-group">
							{{ Form::button(trans('form.btn_submit'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
					</div>
				</div>
				<div class="col-md-6">
					<div id="sort_list">
						<ul class="ui-sortable list-group">
							@foreach($poll->playlists as $pl)
							<li class="list-group-item" id="{{ $pl->polp_id }}">
								<div class="row">
								<!-- <div class="col-md-2">
										#{{ $pl->pl_id }}
								</div> -->
									<div class="col-md-8">
											<i class="fa fa-list"></i> {{ $pl->pl_title }}
									</div>
									<div class="col-md-2 text-center">
											{{ $pl->polp_vote }}
									</div>
									<div class="col-md-2">
											<i class="fa fa-sort"></i>
											<a href="{{ url('poll/playlist/' . $pl->polp_id . '/delete') }}" class="btn-modal"><i class="fa fa-times-circle"></i></a>
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
	var pol_id = $('#pol_id').val();
	var id = ui.item.attr("id");
	$.ajax({
					data: {start_pos:start_pos, end_pos:end_pos, pol_id:pol_id, id:id, _token: "{{ csrf_token() }}"},
					type: 'POST',
					url: '{{url('poll/sort_item')}}'
			});
}
});
</script>
@endsection
