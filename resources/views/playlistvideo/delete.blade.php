@extends('layouts.modal')
@section('content')
{{ Form::open(['url'=>'playlist/video/delete', 'action'=>'POST']) }}
		{{ Form::hidden('plv_id', $video->plv_id) }}
		<h4>@lang('messages.delete_confirm')</h4>
		<div class="form-group">
				{{ Form::button('<i class="fa fa-trash"></i> ' . trans('form.btn_delete'), ['class'=>'btn btn-primary', 'type'=>'submit']) }}
				{{ Form:: button('<i class="fa fa-btn fa-ban"></i>' . trans('form.btn_cancel'), ['class'=>'btn btn-primary cancel-button', 'goto'=> url('playlist') ]) }}
		</div>
{{ Form::close() }}
@endsection
