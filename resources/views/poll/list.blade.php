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
					<th>{{ trans('poll.pol_title') }}</th>
          <th>{{ trans('poll.pol_expiry') }}</th>
					<th>{{ trans('form.action_column') }}</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($polls as $pol)
			<tr>
          <td>{{ $pol->pol_title }}
						<div>
							<span class="label2 label-success"><i class="fa fa-thumbs-o-up"></i> {{ $pol->pol_votes }} votes</span>
							<span class="label2 label-success"><i class="fa fa-clock-o"></i> {{ Carbon::parse($pol->created_at)->diffForHumans() }}</span>
						</div>
					</td>
          <td>{{ Carbon::parse($pol->pol_expiry)->diffForHumans() }}</td>
          <td class="action_column">
              <a href="{{ url('poll/edit/' . $pol->pol_id) }}" title="{{ trans('form.action_edit') }}">{{ Form::button('<i class="fa fa-edit"></i> '.trans('form.btn_edit'), ['class'=>'btn btn-primary btn-small']) }}</a>
              <a href="{{ url('poll/delete/' . $pol->pol_id) }}" title="{{ trans('form.action_delete') }}" class="btn-modal">{{ Form::button('<i class="fa fa-trash"></i> '.trans('form.btn_delete'), ['class'=>'btn btn-primary btn-small']) }}</a>
							<a href="{{ url('public_poll/' . $pol->pol_id) }}" title="{{ trans('form.action_view') }}">{{ Form::button('<i class="fa fa-eye"></i> '.trans('form.btn_view_live'), ['class'=>'btn btn-primary btn-small']) }}</a>
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
