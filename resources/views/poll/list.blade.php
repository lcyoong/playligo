@extends('layouts.list')
@section('content_list')
<div class="page-breadcrumbs">
	<h1 class="section-title">{{ trans('poll.list') }}</h1>
	<div class="world-nav cat-menu">
		<ul class="list-inline">
			<li class="active"><a href="{{ url('poll/create') }}" class=""><span class="fa fa-plus"></span> @lang('poll.new')</a></li>
		</ul>
	</div>
</div>

<div class="section">
<div class="row">
	<div class="col-md-12">
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>{{ trans('poll.pol_id') }}</th>
					<th>{{ trans('poll.pol_title') }}</th>
          <th>{{ trans('form.created_at') }}</th>
					<th>{{ trans('form.action_column') }}</th>
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
</div>
@endsection
