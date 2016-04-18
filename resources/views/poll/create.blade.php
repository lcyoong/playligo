@extends('layouts.app')

@section('content')
<div class="container">
		<div class="page-header page-heading">
				<h2><i class="fa fa-edit"></i> {{ trans('poll.new_title') }}
					<a href="{{ url('poll') }}" class="btn btn-default  pull-right"><span class="fa fa-angle-double-left"></span> @lang('form.back_to_list')</a></h2>
		</div>
		{{ Form::open(['url'=>url('poll/create'), 'method'=>'post', 'class'=>'form-horizontal']) }}
		{{ Form::hidden('pol_user', auth()->user()->id) }}
		<div class="row">
				<div class="col-md-6">
					<div class="row">
						<div class="form-group">
	          	{{ Form::label('pol_title', trans('poll.pol_title'), ['class'=>'col-md-4 control-label']) }}
	          	<div class="col-md-8">
	          		{{ Form::text('pol_title', old('pol_title'), ['class'=>'form-control']) }}
	          	</div>
          	</div>
					</div>
					<div class="row">
						<div class="form-group">
	          	{{ Form::label('pol_description', trans('poll.pol_description'), ['class'=>'col-md-4 control-label']) }}
	          	<div class="col-md-8">
	          		{{ Form::textarea('pol_description', old('pol_description'), ['class'=>'form-control', 'rows'=>5]) }}
	          	</div>
          	</div>
					</div>
					<div class="form-group">
						{{ Form::button(trans('form.btn_submit'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
					</div>
				</div>
		</div>
		{{ Form::close() }}
</div>
@endsection

@section('script')
@endsection
