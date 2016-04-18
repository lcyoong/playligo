@extends('layouts.list')
@section('content_list')
<div class="page-header page-heading">
		<h2><i class="fa fa-list"></i> {{ trans('poll.list') }}
		<a href="{{ url('poll/create') }}" class="btn btn-default  pull-right"><span class="fa fa-plus"></span> @lang('poll.new')</a></h2>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<td>{{ trans('poll.pol_id') }}</td>
					<td>{{ trans('poll.pol_title') }}</td>
          <td>{{ trans('form.created_at') }}</td>
					<td>{{ trans('form.action_column') }}</td>
				</tr>
			</thead>
			<tbody>
			@foreach ($polls as $pol)
			<tr>
          <td>{{ $pol->pol_id }}</td>
          <td>{{ $pol->pol_title }}</td>
          <td>{{ $pol->created_at }}</td>
          <td>
              <a href="{{ url('poll/edit/' . $pol->pol_id) }}" title="{{ trans('form.action_edit') }}"><i class="fa fa-edit"></i></a>
              <a href="{{ url('poll/delete/' . $pol->pol_id) }}" title="{{ trans('form.action_delete') }}" class="btn-modal"><i class="fa fa-trash"></i></a>
							<a href="{{ url('public_poll/' . $pol->pol_id) }}" title="{{ trans('form.action_view') }}"><i class="fa fa-eye"></i></a>
          </td>
			</tr>
			@endforeach
			</tbody>
		</table>
		{{ $polls->links() }}
	</div>
</div>
@endsection
