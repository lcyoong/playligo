@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default ragister-account account-login">
                <div class="panel-body">
                  <h1 class="section-title title">@lang('user.title_reset_password')</h1>
                    {{ Form::open(['method'=>'post', 'url'=>url('/password/email'), 'class'=>'submit-ajax']) }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          {{ Form::label(trans('user.email')) }}
                          <input type="text" class="form-control" name="email" value="{{ old('email') }}">

                          @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                        </div>

                        <div class="submit-button text-center">
                          {{ Form::button(trans('form.btn_reset_password'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
        								</div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
