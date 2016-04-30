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
					<th>{{ trans('playlist.pl_title') }}</th>
          <th>{{ trans('form.created_at') }}</th>
					<th>{{ trans('form.action_column') }}</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($playlists as $pl)
			<tr>
          <td>{{ $pl->pl_title }}</td>
          <td>{{ $pl->created_at }}</td>
          <td>
              <a href="{{ url('playlist/edit/' . $pl->pl_id) }}" title="{{ trans('form.action_edit') }}"><i class="fa fa-edit"></i></a>
              <a href="{{ url('playlist/delete/' . $pl->pl_id) }}" title="{{ trans('form.action_delete') }}" class="btn-modal"><i class="fa fa-trash"></i></a>
							<a href="{{ url('poll/add/' . $pl->pl_id) }}" title="{{ trans('form.action_add_poll') }}" class="btn-modal"><i class="fa fa-plus-square"></i></a>
							<a href="{{ url('public_playlist/' . $pl->pl_id) }}" title="{{ trans('form.action_view') }}"><i class="fa fa-eye"></i></a>
          </td>
			</tr>
			@endforeach
			</tbody>
		</table>
		{{ $playlists->links() }}
	</div>
</div>
</div>
@endsection
