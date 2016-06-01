@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-default ragister-account account-login">
            <div class="panel-body">
              <h1 class="section-title title">@lang('user.title_change_password')</h1>
              {{ Form::open(['method'=>'post', 'url'=>url('/password/edit'), 'class'=>'submit-ajax']) }}
              <div class="form-group">
                {{ Form::label(trans('user.password')) }}
                {{ Form::password('password', ['class'=>'form-control']) }}
              </div>
              <div class="form-group">
                {{ Form::label(trans('user.password_confirmation')) }}
                {{ Form::password('password_confirmation', ['class'=>'form-control']) }}
              </div>
              <div class="form-group">
                {{ Form::button(trans('form.btn_submit'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
              </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
