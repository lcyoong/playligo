@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4">
      {{ Form::button(trans('form.btn_add_to_poll'), ['class'=>'btn btn-primary btn-lg']) }}
    </div>
    <div class="col-md-4">
      {{ Form::button(trans('form.btn_create_add_to_poll'), ['class'=>'btn btn-primary btn-lg']) }}
    </div>
    <div class="col-md-4">
      <a href="{{ url('search') }}">{{ Form::button(trans('form.btn_another_playlist'), ['class'=>'btn btn-primary btn-lg']) }}</a>
    </div>
  </div>
</div>
@endsection
