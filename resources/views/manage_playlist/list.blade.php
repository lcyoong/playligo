@extends('layouts.list')
@section('content_list')
<div class="page-header page-heading">
		<h2><i class="fa fa-list"></i> {{ trans('playlist.list') }}</h2>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<td>{{ trans('playlist.pl_id') }}</td>
					<td>{{ trans('playlist.pl_title') }}</td>
          <td>{{ trans('form.created_at') }}</td>
					<td>{{ trans('form.action_column') }}</td>
				</tr>
			</thead>
			<tbody>
			@foreach ($playlists as $pl)
			<tr>
          <td>{{ $pl->pl_id }}</td>
          <td>{{ $pl->pl_title }}</td>
          <td>{{ $pl->created_at }}</td>
          <td>
              <a href="{{ url('playlist/edit/' . $pl->pl_id) }}" title="{{ trans('form.action_edit') }}"><i class="fa fa-edit"></i></a>
              <a href="{{ url('playlist/delete/' . $pl->pl_id) }}" title="{{ trans('form.action_delete') }}" class="btn-modal"><i class="fa fa-trash"></i></a>
          </td>
			</tr>
			@endforeach
			</tbody>
		</table>
		{{ $playlists->links() }}
	</div>
</div>
@endsection
