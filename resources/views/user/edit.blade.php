@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="panel panel-default ragister-account account-login">
            <div class="panel-body">
              <h1 class="section-title title">@lang('user.title_edit_profile')</h1>
              {{ Form::open(['method'=>'post', 'url'=>url('/profile/edit'), 'class'=>'submit-ajax']) }}
              {{ Form::hidden('id', $user->id) }}
              <div class="form-group">
                {{ Form::label('name', trans('user.name'), ['class'=>'control-label']) }}
                {{ Form::text('name', $user->name, ['class'=>'form-control']) }}
              </div>
              <div class="form-group">
                {{ Form::label('email', trans('user.email'), ['class'=>'control-label']) }}
                {{ Form::text('email', $user->email, ['class'=>'form-control']) }}
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
