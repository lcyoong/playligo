@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4 text-center">
      {{ Form::open(['url'=>url('poll/add'), 'method'=>'post']) }}
      {{ Form::hidden('polp_playlist', $playlist->pl_id) }}
      <div class="form-group">
        {{ Form::select('polp_poll', $dd_polls, '', ['class'=>'form-control']) }}
      </div>
      {{ Form::button(trans('form.btn_add_to_poll'), ['class'=>'btn btn-primary btn-lg', 'type'=>'submit', $disabled]) }}
      {{ Form::close() }}
    </div>
    <div class="col-md-4 text-center">
      {{ Form::open(['url'=>url('poll/create_add'), 'method'=>'post']) }}
      {{ Form::hidden('pol_playlist', $playlist->pl_id) }}
      <div class="form-group">
        {{ Form::text('pol_title', '', ['class'=>'form-control']) }}
      </div>
      {{ Form::button(trans('form.btn_create_add_to_poll'), ['class'=>'btn btn-primary btn-lg', 'type'=>'submit']) }}
      {{ Form::close() }}
    </div>
    <div class="col-md-4 text-center">
      <div style="font-size: 2.5em"><i class="fa fa-list"></i></div>
      <a href="{{ url('search') }}">{{ Form::button(trans('form.btn_another_playlist'), ['class'=>'btn btn-primary btn-lg']) }}</a>
    </div>
  </div>
</div>
@endsection
