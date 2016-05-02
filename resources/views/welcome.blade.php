@extends('layouts.teaser')

@section('content')
<div class="container homepage-main">
<div class="row">
  <div class="col-md-6">
    <img src="{{ asset('img/logo-main.png') }}">
    <h1>Revolutionize the way you travel! Watch short curated destination video playlists before you go.</h1>
    <h2>Be inspired. Decide with confidence.</h2>
    <h4>Be among the first to enjoy this amazing travel tool</h4>
    {{ Form::open(['action'=>'post', 'url'=>url('subscribe'), 'class'=>'form-homepage']) }}
    <div class="row">
      <div class="col-md-4">
        <div class="form-group">
        {{ Form::email('email', '', ['class'=>'form-control input-lg', 'placeholder'=>'Your Email']) }}
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
        {{ Form::email('name', '', ['class'=>'form-control input-lg', 'placeholder'=>'Your Name']) }}
        </div>
      </div>
      <div class="col-md-4">
        <div class="form-group">
        {{ Form::button('Count me in!', ['type'=>'button', 'class'=>'btn btn-primary button-homepage btn-lg']) }}
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
