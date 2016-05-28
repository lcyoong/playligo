@extends('layouts.admin_list')
@section('content_list')
<div class="section">
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th class="col-md-4">{{ trans('poll.pol_title') }}</th>
					<th class="col-md-4">{{ trans('poll.pol_user') }}</th>
          <th class="col-md-2">{{ trans('form.created_at') }}</th>
					<th class="col-md-2">{{ trans('form.action_column') }}</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($polls as $pol)
			<tr>
          <td>{{ $pol->pol_title }}</td>
					<td><a href="{{ url('admin/user/popup/' . $pol->pol_user) }}" class="btn-modal"><i class="fa fa-eye"></i></a> {{ $pol->name }}</td>
          <td>{{ $pol->created_at }}</td>
          <td class="action_column">
              <a href="{{ url('poll/edit/' . $pol->pol_id) }}" title="{{ trans('form.action_edit') }}"><i class="fa fa-edit"></i></a>
              <a href="{{ url('poll/delete/' . $pol->pol_id) }}" title="{{ trans('form.action_delete') }}" class="btn-modal"><i class="fa fa-trash"></i></a>
							<a href="{{ url('public_poll/' . $pol->pol_id) }}" title="{{ trans('form.action_view') }}"><i class="fa fa-eye"></i></a>
          </td>
			</tr>
			@endforeach
			</tbody>
		</table>
		<div class="pagination-wrapper">
			{{ $polls->links() }}
		</div>
	</div>
</div>
</div>
@endsection
