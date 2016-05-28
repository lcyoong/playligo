@extends('layouts.list')
@section('content_list')
<div class="page-breadcrumbs">
	<h1 class="section-title">{{ trans('playlist.list') }}</h1>
	<div class="world-nav cat-menu">
		<ul class="list-inline">
			<li class="active"><a href="{{ url('search') }}" class=""><span class="fa fa-plus"></span> @lang('playlist.new')</a></li>
		</ul>
	</div>
</div>

<div class="section">
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th class="" colspan="2">{{ trans('playlist.pl_title') }}</th>
					<th class="">{{ trans('form.action_column') }}</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($playlists as $pl)
			<tr>
				<td>
					<img class="video_thumb img-rounded" src="{{ $pl->pl_thumb_path or asset(config('playligo.video_thumb_default')) }}">
				</td>
        <td>
					{{ $pl->pl_title }}
					<div>
						<span class="label2 label-success"><i class="fa fa-eye"></i> {{ $pl->pl_view }} views</span>
						<span class="label2 label-success"><i class="fa fa-star"></i> {{ $pl->pl_rating }}</span>
					</div>
				</td>
        <td class="action_column">
            <a href="{{ url('playlist/edit/' . $pl->pl_id) }}" title="{{ trans('form.action_edit') }}">{{ Form::button('<i class="fa fa-edit"></i> '.trans('form.btn_edit'), ['class'=>'btn btn-primary btn-small']) }}</a>
            <a href="{{ url('playlist/delete/' . $pl->pl_id) }}" title="{{ trans('form.action_delete') }}" class="btn-modal">{{ Form::button('<i class="fa fa-trash"></i> '.trans('form.btn_delete'), ['class'=>'btn btn-primary btn-small']) }}</a>
						<a href="{{ url('poll/add/' . $pl->pl_id) }}" title="{{ trans('form.action_add_poll') }}" class="btn-modal">{{ Form::button('<i class="fa fa-plus"></i> '.trans('form.btn_add_to_poll_alt'), ['class'=>'btn btn-primary btn-small']) }}</a>
						<a href="{{ url('public_playlist/' . $pl->pl_id) }}" title="{{ trans('form.action_view') }}">{{ Form::button('<i class="fa fa-eye"></i> '.trans('form.btn_view_live'), ['class'=>'btn btn-primary btn-small']) }}</a>
        </td>
			</tr>
			@endforeach
			</tbody>
		</table>
		<div class="pagination-wrapper">
			{{ $playlists->links() }}
		</div>
	</div>
</div>
</div>
@endsection
