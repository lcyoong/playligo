@extends('layouts.modal')
@section('content')
{{ Form::open(['url'=>'poll/add', 'action'=>'POST', 'class'=>'submit-ajax']) }}
		{{ Form::hidden('polp_playlist', $playlist->pl_id) }}
		<h4>@lang('poll.add_playlist')</h4>
		<div class="form-group">
			{{ Form::select('polp_poll', $dd_polls, '', ['class'=>'form-control']) }}
		</div>
		<div class="form-group">
				{{ Form::button(trans('form.btn_submit'), ['class'=>'btn btn-primary', 'type'=>'submit']) }}
				<!-- {{ Form:: button('<i class="fa fa-btn fa-ban"></i>' . trans('form.btn_cancel'), ['class'=>'btn btn-primary cancel-button', 'goto'=> url('poll') ]) }} -->
		</div>
{{ Form::close() }}
@endsection
