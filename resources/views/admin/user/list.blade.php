@extends('layouts.admin_list')
@section('content_list')
<div class="section">
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>{{ trans('user.name') }}</th>
					<th>{{ trans('user.email') }}</th>
					<th>{{ trans('form.action_column') }}</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($users as $user)
			<tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td class="action_column">
              <a href="{{ url('admin/user/edit/' . $user->id) }}" title="{{ trans('form.action_edit') }}"><i class="fa fa-edit"></i></a>
							<a href="{{ url('admin/user/popup/' . $user->id) }}" class="btn-modal"><i class="fa fa-eye"></i></a>
          </td>
			</tr>
			@endforeach
			</tbody>
		</table>
		<div class="pagination-wrapper">
			{{ $users->links() }}
		</div>
	</div>
</div>
</div>
@endsection
