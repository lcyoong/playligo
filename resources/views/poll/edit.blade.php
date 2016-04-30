@extends('layouts.app')

@section('content')
<div class="container">
	<div class="page-breadcrumbs">
		<h1 class="section-title">{{ trans('poll.edit_title') }}</h1>
		<div class="world-nav cat-menu">
			<ul class="list-inline">
				<li class="active"><a href="{{ url('poll') }}" class=""><span class="fa fa-angle-double-left"></span> @lang('form.back_to_list')</a></li>
			</ul>
		</div>
	</div>

	<div class="section details-news">
		<div class="entry-meta">
			<ul class="list-inline">
				<li class="posted-by"><i class="fa fa-user"></i> by <a href="#">{{ $owner->name }}</a></li>
				<li class="publish-date"><a href="#"><i class="fa fa-clock-o"></i> {{ $poll->created_at }} </a></li>
				<li class="views"><a href="#"><i class="fa fa-eye"></i> {{ $poll->pol_view }}</a></li>
				<!-- <li class="loves"><a href="#"><i class="fa fa-heart-o"></i>278</a></li>
				<li class="comments"><i class="fa fa-comment-o"></i><a href="#">189</a></li> -->
			</ul>
		</div>
		{{ Form::open(['url'=>url('poll/edit'), 'method'=>'post', 'class'=>'']) }}
		{{ Form::hidden('pol_id', $poll->pol_id, ['id'=>'pol_id']) }}
		<div class="row">
				<div class="col-md-6">
						<div class="form-group">
	          	{{ Form::label('pol_title', trans('poll.pol_title'), ['class'=>'control-label']) }}
          		{{ Form::text('pol_title', $poll->pol_title, ['class'=>'form-control']) }}
          	</div>
						<div class="form-group">
	          	{{ Form::label('pol_description', trans('poll.pol_description'), ['class'=>'control-label']) }}
          		{{ Form::textarea('pol_description', $poll->pol_description, ['class'=>'form-control', 'rows'=>5]) }}
          	</div>
						<!-- <div class="form-group">
							{{ Form::label('pol_description', trans('form.created_at'), ['class'=>'control-label']) }}
							{{ Form::label('pol_description', $poll->created_at, ['class'=>'col-md-8 control-label']) }}
						</div>
						<div class="form-group">
							{{ Form::label('pol_description', trans('form.updated_at'), ['class'=>'col-md-4 control-label']) }}
							{{ Form::label('pol_description', $poll->updated_at, ['class'=>'col-md-8 control-label']) }}
						</div> -->
						<div class="form-group">
								{{ Form::button(trans('form.btn_submit'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
						</div>
				</div>
				<div class="col-md-6">
					<div id="sort_list" class="video-post-list">
						<h5>Playlists</h5>
						<ul class="ui-sortable list-group">
							@foreach($poll->playlists as $pl)
							<li class="list-group-item" id="{{ $pl->polp_id }}">
								<div class="post video-post small-post">
									<div class="entry-header">
										<div class="entry-thumbnail embed-responsive embed-responsive-16by9">
											<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/-WlqrkXImsk" allowfullscreen=""></iframe>
										</div>
									</div>
									<div class="post-content">
										<!-- <div class="video-catagory"><a href="#">World</a></div> -->
										<h2 class="entry-title pull-left">
											{{ $pl->pl_title }}
											<div>
												<i class="fa fa-thumbs-o-up"></i> {{ $pl->polp_vote }}
											</div>
										</h2>
										<div class="pull-right">
											<a href="{{ url('poll/playlist/' . $pl->polp_id . '/delete') }}" class="btn-modal"><i class="fa fa-times-circle"></i></a>
										</div>
									</div>
								</div>
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
