@extends('layouts.app_home')

@section('content')
<div class="text-center home-content">
  <div class="home-content-inner">
    <h1>Inspire Your Getaway</h1>
    <h2>Watch travel playlists before going...</h2>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <a href="{{ url('search') }}#suggest">{{ Form::button('Show Me', ['class'=>'btn btn-primary']) }}</a>&nbsp;&nbsp;&nbsp;
          <a href="{{ url('search') }}">{{ Form::button("I'm thinking of...", ['class'=>'btn btn-primary']) }}</a>
        </div>
    </div>
  </div>
</div>
@endsection
