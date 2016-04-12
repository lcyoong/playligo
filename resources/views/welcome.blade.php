@extends('layouts.teaser')

@section('content')
<div class="container homepage">
<div class="row">
  <div class="col-md-6">
    <img src="{{ asset('img/logo.png') }}">
    <h1>Watch destination video playlists before you go for your next trip.</h1>
    <h2>Be inspired. Decide with confidence.</h2>
    <h4>Sign up for the pre-launch sneak preview now!</h4>
    {{ Form::open(['action'=>'post', 'url'=>'', 'class'=>'form-homepage']) }}
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
        {{ Form::text('email', '', ['class'=>'form-control input-lg']) }}
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
        {{ Form::button('Subscribe', ['type'=>'button', 'class'=>'btn btn-primary button-homepage btn-lg']) }}
        </div>
      </div>
    </div>
    {{ Form::close() }}
  </div>
  <div class="col-md-6">
    <img src="{{ asset('img/phone-mockup.png') }}" class="img-responsive img-center">
  </div>
</div>
</div>
@endsection
