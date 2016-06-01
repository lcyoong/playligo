@extends('layouts.app')

@section('content')
<div class="container">
	<div class="page-breadcrumbs">
		<h1 class="section-title">{{ trans('poll.new_title') }}</h1>
		<div class="world-nav cat-menu">
			<ul class="list-inline">
				<li class="active"><a href="{{ url('poll') }}" class=""><span class="fa fa-angle-double-left"></span> @lang('form.back_to_list')</a></li>
			</ul>
		</div>
	</div>

	<div class="section">
		{{ Form::open(['url'=>url('poll/create'), 'method'=>'post', 'class'=>'submit-ajax']) }}
		{{ Form::hidden('pol_user', auth()->user()->id) }}
		<div class="row">
				<div class="col-md-6">
						<div class="form-group">
	          	{{ Form::label('pol_title', trans('poll.pol_title'), ['class'=>'control-label']) }}
          		{{ Form::text('pol_title', old('pol_title'), ['class'=>'form-control']) }}
          	</div>
						<div class="form-group">
	          	{{ Form::label('pol_expiry', trans('poll.pol_expiry'), ['class'=>'control-label']) }}
							<div class="input-group">
	          		{{ Form::text('pol_expiry', date('d-m-Y', strtotime('+14 days')), ['class'=>'form-control datepicker']) }}
								<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
							</div>
          	</div>
						<div class="form-group">
	          	{{ Form::label('pol_description', trans('poll.pol_description'), ['class'=>'control-label']) }}
          		{{ Form::textarea('pol_description', old('pol_description'), ['class'=>'form-control', 'rows'=>5]) }}
          	</div>
						<div class="form-group">
							{{ Form::button(trans('form.btn_submit'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
						</div>
				</div>
		</div>
		{{ Form::close() }}
	</div>
</div>
@endsection

@section('style')
<link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endsection

@section('script')
<script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
<script>
$('.datepicker').datetimepicker({
	format: 'DD-MM-YYYY',
});
</script>
@endsection
