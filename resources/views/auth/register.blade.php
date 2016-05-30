@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default ragister-account">
                <div class="panel-body">
                  <h1 class="section-title title">@lang('user.title_register')</h1>
                    <form role="form" method="POST" action="{{ url('/register') }}" class="submit-ajax">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {{ Form::label(trans('user.name')) }}
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif

                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                          {{ Form::label(trans('user.email')) }}
                          <input type="text" class="form-control" name="email" value="{{ old('email') }}">

                          @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                          {{ Form::label(trans('user.password')) }}
                          <input type="password" class="form-control" name="password">

                          @if ($errors->has('password'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                          {{ Form::label(trans('user.password_confirmation')) }}
                          <input type="password" class="form-control" name="password_confirmation">

                          @if ($errors->has('password_confirmation'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('password_confirmation') }}</strong>
                              </span>
                          @endif
                        </div>

                        <div class="submit-button text-center">
                          {{ Form::button(trans('user.register'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
